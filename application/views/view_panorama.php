
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="World in 360: <?= $data['title'] ?>">
		<meta name="author" content="Riddhiman Adib">

  		<title>World in 360: <?= $data['title'] ?></title>

  		<meta property="og:title" content="World in 360 : Riddhiman Adib">
		<!--meta property="og:image" content="http://example.com/images/photo.jpg"-->
		<meta property="og:description" content="World in 360: Been Here - Done That - Captured That">
		<meta property="og:url" content="https://world-in-360.herokuapp.com">

		<!-- Loading Bootstrap -->
  		<link href="https://world-in-360.herokuapp.com/assets/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  		<!-- Loading Flat UI -->
		<link href="https://world-in-360.herokuapp.com/assets/css/flat-ui.min.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="https://world-in-360.herokuapp.com/assets/css/riddhi-custom.css" rel="stylesheet">
		<!-- Custom FONT -->
		<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
		<!-- Custom CSS for progress -->
		<link href="https://world-in-360.herokuapp.com/assets/css/progressjs.min.css" rel="stylesheet">
		<!-- Custom ICON -->
		<link rel="shortcut icon" href="https://world-in-360.herokuapp.com/assets/img/color-palette.ico">

	</head>


	<body id="pano_body">

		<div id="container"></div>
		<div id="info">
			<div style="font-size:16px;"><?= $data['title']?></div>
			<div style="font-size:14px;"><?= $data['desc'] ?></div>
			<div style="font-size:14px;"><i>Use Mouse to drag and view - Press F11 for full-screen experience</i></div>

			<div id="loadBox" style="height: 660px; width: 500px; background-color:#808080; text-align:center; display: inline-block;"></div>

			<!--div id="progressBox">
			  <div id="progressLevel">
			    <div id="progressLabel">0%</div>
			  </div>
			</div-->

		</div>

		<script src="https://world-in-360.herokuapp.com/assets/js/three.min.js"></script>
		<script src="https://world-in-360.herokuapp.com/assets/js/progress.min.js"></script>

		<script>

			var camera, scene, renderer;
			var container, mesh, material, geometry;
			var progressValue;
			var progressBox, progressLevel;
			var width = 0;
			var loadBox;

			var isUserInteracting = false,
			onMouseDownMouseX = 0, onMouseDownMouseY = 0,
			lon = 0, onMouseDownLon = 0,
			lat = 0, onMouseDownLat = 0,
			phi = 0, theta = 0;

			init();
			animate();

			function init() {

				container = document.getElementById( 'container' );
				loadBox = document.getElementById("loadBox");
				// progressBox = document.getElementById("progressBox");
				// progressLevel = document.getElementById("progressLevel");
				// progressLabel = document.getElementById("progressLabel");

				camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 1100 );
				camera.target = new THREE.Vector3( 0, 0, 0 );

				progressJs("#container").setOptions({overlayMode: true, theme: 'blueOverlayRadiusWithPercentBar'}).start();

				scene = new THREE.Scene();

				geometry = new THREE.SphereGeometry( 500, 60, 40 );
				geometry.scale( - 1, 1, 1 );

				material = new THREE.MeshBasicMaterial( {
					map: new THREE.TextureLoader().load( 'https://world-in-360.herokuapp.com/assets/img/panorama/main/<?= $data['name'] ?>.jpg', onLoadCompleted, onLoadProgress, onFailed )
				});

			}

			function onLoadCompleted( texture ) {
				// do something with the texture
				// progressBox.style.visibility = "hidden";
				progressJs("#loadBox").end();
				showImage();
			}

			// Function called when download progresses
			function onLoadProgress( xhr ) {
				// console.log( (xhr.loaded / xhr.total * 100) + '% loaded' );
				progressValue = Math.round( (xhr.loaded / xhr.total * 100) );
				progressJs("#loadBox").set(progressValue);
				// setProgress(progressValue);
				// console.log("outside val: " + progressValue);
			}

			// Function called when download errors
			function onFailed( xhr ) {
				// console.log( 'An error happened' );
				// progressBox.style.visibility = "hidden";
				progressJs("#loadBox").end();
			}

			function setProgress(value) {
				console.log("started");

			  if (width <= 100) {
			    width = value;
			    console.log("val: " + value);
			    progressLevel.style.width = width + '%';
			    progressLabel.innerHTML = width * 1  + '%';
			  }
			}

			function showImage() {

				mesh = new THREE.Mesh( geometry, material );

				scene.add( mesh );

				renderer = new THREE.WebGLRenderer();
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );

				document.addEventListener( 'mousedown', onDocumentMouseDown, false );
				document.addEventListener( 'mousemove', onDocumentMouseMove, false );
				document.addEventListener( 'mouseup', onDocumentMouseUp, false );
				document.addEventListener( 'mousewheel', onDocumentMouseWheel, false );
				document.addEventListener( 'MozMousePixelScroll', onDocumentMouseWheel, false);

				//

				document.addEventListener( 'dragover', function ( event ) {

					event.preventDefault();
					event.dataTransfer.dropEffect = 'copy';

				}, false );

				document.addEventListener( 'dragenter', function ( event ) {

					document.body.style.opacity = 0.5;

				}, false );

				document.addEventListener( 'dragleave', function ( event ) {

					document.body.style.opacity = 1;

				}, false );

				document.addEventListener( 'drop', function ( event ) {

					event.preventDefault();

					var reader = new FileReader();
					reader.addEventListener( 'load', function ( event ) {

						material.map.image.src = event.target.result;
						material.map.needsUpdate = true;

					}, false );
					reader.readAsDataURL( event.dataTransfer.files[ 0 ] );

					document.body.style.opacity = 1;

				}, false );

				//

				window.addEventListener( 'resize', onWindowResize, false );
			}

			function onWindowResize() {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function onDocumentMouseDown( event ) {

				event.preventDefault();

				isUserInteracting = true;

				onPointerDownPointerX = event.clientX;
				onPointerDownPointerY = event.clientY;

				onPointerDownLon = lon;
				onPointerDownLat = lat;

			}

			function onDocumentMouseMove( event ) {

				if ( isUserInteracting === true ) {

					lon = ( onPointerDownPointerX - event.clientX ) * 0.1 + onPointerDownLon;
					lat = ( event.clientY - onPointerDownPointerY ) * 0.1 + onPointerDownLat;

				}

			}

			function onDocumentMouseUp( event ) {

				isUserInteracting = false;

			}

			function onDocumentMouseWheel( event ) {

				// WebKit

				if ( event.wheelDeltaY ) {

					camera.fov -= event.wheelDeltaY * 0.05;

				// Opera / Explorer 9

				} else if ( event.wheelDelta ) {

					camera.fov -= event.wheelDelta * 0.05;

				// Firefox

				} else if ( event.detail ) {

					camera.fov += event.detail * 1.0;

				}

				camera.updateProjectionMatrix();

			}

			function animate() {

				requestAnimationFrame( animate );
				update();

			}

			function update() {

				if ( isUserInteracting === false ) {

					lon += 0.05;

				}

				lat = Math.max( - 85, Math.min( 85, lat ) );
				phi = THREE.Math.degToRad( 90 - lat );
				theta = THREE.Math.degToRad( lon );

				camera.target.x = 500 * Math.sin( phi ) * Math.cos( theta );
				camera.target.y = 500 * Math.cos( phi );
				camera.target.z = 500 * Math.sin( phi ) * Math.sin( theta );

				camera.lookAt( camera.target );

				/*
				// distortion
				camera.position.copy( camera.target ).negate();
				*/

				renderer.render( scene, camera );

			}

		</script>
	</body>
</html>
