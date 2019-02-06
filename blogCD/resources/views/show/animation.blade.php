<!DOCTYPE html>
<html lang="en">
<head>
   <title>three.js webgl - instancing test (single triangle)</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
   <style>
      body {
         color: #ffffff;
         font-family: Monospace;
         font-size: 13px;
         text-align: center;
         font-weight: bold;
         background-color: #000000;
         margin: 0px;
         overflow: hidden;
      }
      #info {
         position: absolute;
         top: 0px;
         width: 100%;
         padding: 5px;
      }
      a {
         color: #ffffff;
      }
      #webglmessage a {
         color: #da0;
      }
      #notSupported {
         width: 50%;
         margin: auto;
         border: 2px red solid;
         margin-top: 20px;
         padding: 10px;
      }
   </style>
</head>
<body>

   <div id="container"></div>
   <div id="info">

      <div id="notSupported" style="display:none">Sorry your graphics card + browser does not support hardware instancing</div>
   </div>

   <script src="js/libs/dat.gui.min.js"></script>
   <script src="js/three.js"></script>
   <script src="js/libs/stats.min.js"></script>
   <script src="js/WebGL.js"></script>

   <script id="vertexShader" type="x-shader/x-vertex">
      precision highp float;
      uniform float sineTime;
      uniform mat4 modelViewMatrix;
      uniform mat4 projectionMatrix;
      attribute vec3 position;
      attribute vec3 offset;
      attribute vec4 color;
      attribute vec4 orientationStart;
      attribute vec4 orientationEnd;
      varying vec3 vPosition;
      varying vec4 vColor;
      void main(){
         vPosition = offset * max( abs( sineTime * 2.0 + 1.0 ), 0.5 ) + position;
         vec4 orientation = normalize( mix( orientationStart, orientationEnd, sineTime ) );
         vec3 vcV = cross( orientation.xyz, vPosition );
         vPosition = vcV * ( 2.0 * orientation.w ) + ( cross( orientation.xyz, vcV ) * 2.0 + vPosition );
         vColor = color;
         gl_Position = projectionMatrix * modelViewMatrix * vec4( vPosition, 1.0 );
      }
   </script>

   <script id="fragmentShader" type="x-shader/x-fragment">
      precision highp float;
      uniform float time;
      varying vec3 vPosition;
      varying vec4 vColor;
      void main() {
         vec4 color = vec4( vColor );
         color.r += sin( vPosition.x * 10.0 + time ) * 0.5;
         gl_FragColor = color;
      }
   </script>

   <script>
      if ( WEBGL.isWebGLAvailable() === false ) {
         document.body.appendChild( WEBGL.getWebGLErrorMessage() );
      }
      var container, stats;
      var camera, scene, renderer;
      init();
      animate();
      function init() {
         container = document.getElementById( 'container' );
         camera = new THREE.PerspectiveCamera( 50, window.innerWidth / window.innerHeight, 1, 10 );
         camera.position.z = 2;
         scene = new THREE.Scene();
         // geometry
         var vector = new THREE.Vector4();
         var instances = 50000;
         var positions = [];
         var offsets = [];
         var colors = [];
         var orientationsStart = [];
         var orientationsEnd = [];
         positions.push( 0.025, - 0.025, 0 );
         positions.push( - 0.025, 0.025, 0 );
         positions.push( 0, 0, 0.025 );
         // instanced attributes
         for ( var i = 0; i < instances; i ++ ) {
            // offsets
            offsets.push( Math.random() - 0.5, Math.random() - 0.5, Math.random() - 0.5 );
            // colors
            colors.push( Math.random(), Math.random(), Math.random(), Math.random() );
            // orientation start
            vector.set( Math.random() * 2 - 1, Math.random() * 2 - 1, Math.random() * 2 - 1, Math.random() * 2 - 1 );
            vector.normalize();
            orientationsStart.push( vector.x, vector.y, vector.z, vector.w );
            // orientation end
            vector.set( Math.random() * 2 - 1, Math.random() * 2 - 1, Math.random() * 2 - 1, Math.random() * 2 - 1 );
            vector.normalize();
            orientationsEnd.push( vector.x, vector.y, vector.z, vector.w );
         }
         var geometry = new THREE.InstancedBufferGeometry();
         geometry.maxInstancedCount = instances; // set so its initalized for dat.GUI, will be set in first draw otherwise
         geometry.addAttribute( 'position', new THREE.Float32BufferAttribute( positions, 3 ) );
         geometry.addAttribute( 'offset', new THREE.InstancedBufferAttribute( new Float32Array( offsets ), 3 ) );
         geometry.addAttribute( 'color', new THREE.InstancedBufferAttribute( new Float32Array( colors ), 4 ) );
         geometry.addAttribute( 'orientationStart', new THREE.InstancedBufferAttribute( new Float32Array( orientationsStart ), 4 ) );
         geometry.addAttribute( 'orientationEnd', new THREE.InstancedBufferAttribute( new Float32Array( orientationsEnd ), 4 ) );
         // material
         var material = new THREE.RawShaderMaterial( {
            uniforms: {
               "time": { value: 1.0 },
               "sineTime": { value: 1.0 }
            },
            vertexShader: document.getElementById( 'vertexShader' ).textContent,
            fragmentShader: document.getElementById( 'fragmentShader' ).textContent,
            side: THREE.DoubleSide,
            transparent: true
         } );
         //
         var mesh = new THREE.Mesh( geometry, material );
         scene.add( mesh );
         //
         renderer = new THREE.WebGLRenderer();
         renderer.setPixelRatio( window.devicePixelRatio );
         renderer.setSize( window.innerWidth, window.innerHeight );
         container.appendChild( renderer.domElement );
         if ( renderer.extensions.get( 'ANGLE_instanced_arrays' ) === null ) {
            document.getElementById( 'notSupported' ).style.display = '';
            return;
         }
         //
         var gui = new dat.GUI( { width: 350 } );
         gui.add( geometry, 'maxInstancedCount', 0, instances );
         //
         stats = new Stats();
         container.appendChild( stats.dom );
         //
         window.addEventListener( 'resize', onWindowResize, false );
      }
      function onWindowResize() {
         camera.aspect = window.innerWidth / window.innerHeight;
         camera.updateProjectionMatrix();
         renderer.setSize( window.innerWidth, window.innerHeight );
      }
      //
      function animate() {
         requestAnimationFrame( animate );
         render();
         stats.update();
      }
      function render() {
         var time = performance.now();
         var object = scene.children[ 0 ];
         object.rotation.y = time * 0.0005;
         object.material.uniforms[ "time" ].value = time * 0.005;
         object.material.uniforms[ "sineTime" ].value = Math.sin( object.material.uniforms[ "time" ].value * 0.05 );
         renderer.render( scene, camera );
      }
   </script>

</body>

</html>
