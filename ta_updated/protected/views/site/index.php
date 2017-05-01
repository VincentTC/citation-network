<?php /* @var $this SiteController */
	$this->pageTitle=Yii::app()->name;
?>

<!-- Script ini digunakan untuk menentukan nilai-nilai default yang akan digunakan sesuai dengan sesinya -->
<script type="text/javascript">
	var userID, defaultX, defaultY, defaultEdge, defaultParameter;
	var dataString = "";
	var help;
	var SelectedId;
	var defaultZoom;
	var defaultPan;
	<?php
		if (!Yii::app()->user->isGuest)
			echo ('userID='.Yii::app()->user->id.';');
		else
			echo 'userID="";';

		if(isset(Yii::app()->session['help'])) {
			echo('help='.Yii::app()->session['help'].';');
		} else {
			echo 'help="";';
		}

		if(isset(Yii::app()->session['IdPaper'])) {
			echo ('SelectedId="'.Yii::app()->session['IdPaper'].'";');
			// echo ('SelectedId="7,8,10,11,12,13,14,15,16,17,18,19,54,55,56,67,68,69,70,71,72,151,152,153,154,155,157,158,159,160,168,170,174,175";');
		} else {
			echo ('SelectedId="7,8,10,11,12,13,14,15,16,17,18,19,54,55,56,67,68,69,70,71,72,151,152,153,154,155,157,158,159,160,168,170,174,175";');
			// echo ('SelectedId="'.Yii::app()->session['IdPaper'].'";');
		}

		if(isset(Yii::app()->session['Edge'])) {
			echo ('defaultEdge="'.Yii::app()->session['Edge'].'";');
		} else {
			echo ('defaultEdge="Citation";');
		}

		if(isset(Yii::app()->session['sbX'])) {
			echo ('defaultX="'.Yii::app()->session['sbX'].'";');
		} else {
			echo ('defaultX="Domain Data";');
		}

		if(isset(Yii::app()->session['sbY'])) {
			echo ('defaultY="'.Yii::app()->session['sbY'].'";');
		} else {
			echo ('defaultY="Tahun Publikasi";');
		}

		if(isset(Yii::app()->session['zooming'])) {
			echo ('defaultZoom="'.Yii::app()->session['zooming'].'";');
		} else {
			echo ('defaultZoom="Breadcrumbs";');
		}
		if(isset(Yii::app()->session['pan']))
		{
			echo ('defaultPan="'.Yii::app()->session['pan'].'";');
		}
		else
		{
			echo ('defaultPan="Linier";');
		}
	?>
</script>

<!-- Script ini digunakan untuk mendapatkan nilai-nilai default -->
<script>
	var a = "<?php echo Yii::app()->request->getParam('r');?>".split("/");

	if(typeof a[2] === "undefined" || a.length==2) {
		defaultParameter = SelectedId;
	} else {
		defaultX = a[2];
		defaultY = a[3];
		defaultParameter = a[4];
		defaultEdge = a[5];
		defaultZoom = a[6];
		defaultPan = a[7];
	}   
</script>

<body id="body" onLoad="getDataInit(defaultX, defaultY, defaultParameter, defaultEdge, defaultZoom, defaultPan)">
	<!-- Import file -->
	<?php  
		$baseUrl = Yii::app()->baseUrl; 
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($baseUrl.'/js/d3.min.js');
		$cs->registerScriptFile($baseUrl.'/js/fisheye.js');
		$cs->registerScriptFile($baseUrl.'/js/json2.js');
		$cs->registerScriptFile($baseUrl.'/js/context-menu.js');
		$cs->registerScriptFile($baseUrl.'/js/bootstrap.js');
		$cs->registerScriptFile($baseUrl.'/js/jquery.dataTables.js');
		$cs->registerScriptFile($baseUrl.'/js/dataTables.scroller.js');
		$cs->registerScriptFile($baseUrl.'/js/d3.layout.cloud.js');  
		$cs->registerScriptFile($baseUrl.'/js/jquery.tipsy.js');
		// $cs->registerScriptFile($baseUrl.'/js/jquery.min.js');
		$cs->registerScriptFile($baseUrl.'/js/intro.js');
		$cs->registerScriptFile($baseUrl.'/js/fisheyePan.js'); 
		$cs->registerScriptFile($baseUrl.'/js/aStar.js');

		$cs->registerCssFile($baseUrl.'/css/fisheye.css');
		$cs->registerCssFile($baseUrl.'/css/bootstrap.css');
		$cs->registerCssFile($baseUrl.'/css/jquery.dataTables.css');
		$cs->registerCssFile($baseUrl.'/css/dataTables.scroller.css');
		$cs->registerCssFile($baseUrl.'/css/TA.css');
		$cs->registerCssFile($baseUrl.'/css/tipsy.css');
		$cs->registerCssFile($baseUrl.'/css/introjs.css');
		$cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css');
	?>

	<!-- Tampilan di sebelah kanan peta penelitian, yaitu: jumlah paper, pemilihan parameter untuk: sumbu x, sumbu y, dan relasi -->
	<div class="right-content">
		<!-- Header -->

		<!-- Header untuk menampilkan jumlah paper -->
		<label style="width:100px; margin-left: 15px;">Jumlah Paper</label>
		<label style="width:13px">:</label>
		<div id="jumlahPaper" style="float:right; margin-right:34px; font-weight:bold;"></div>
 
		<br/>
		<br/>

		<!-- Fitur memilih paper yang akan ditampilkan -->
		<a href="#AddPaper" id="login_pop" class="button" style="margin-left: 15px;" data-intro="Tombol ini digunakan untuk menambahkan dan mengurangi paper yang akan divisualisasikan" data-step="2">
			Pilih Paper
		</a>
		
		<div>
			<a href="#SavePaper" id="save_paper" class="button" style="margin-top:15px; margin-right: 34px; margin-bottom: 30px; float:right">
				<!--<span class="glyphicon glyphicon-plus"></span>-->
				Simpan Peta
			</a>
		</div>
 
		<!-- Menampilkan help untuk pengguna -->
		<script>
			function startIntro(data) {
				var intro = introJs();

				// Mendefinisikan konten help
				intro.setOptions({
					steps: [
						{
							element:'#logo',
							intro:"Visualisasi yang membantu peneliti untuk <b>mengelompokkan paper</b> berdasarkan parameter tertentu. Digunakan untuk <b>memetakan penelitian</b> yang sudah ada, sehingga memudahkan peneliti untuk <b>menemukan topik penelitian</b> yang akan dikerjakannya"
						},
						// {
						//  element:'#login',
						//  intro:"<b style=\"font-size:20px\">Masuk</b><br/><br/>Pengguna yang telah masuk dapat menyimpan dan melihat peta penelitian yang telah ia simpan"
						// },
						{
							element: '#login_pop',
							intro: "<b style=\"font-size:20px\">Pilih Paper</b><br/><br/>Tombol ini digunakan untuk <b>menambahkan</b> dan <b>mengurangi</b> paper yang akan <b>divisualisasikan</b>"
						},
						{
							element: '.sub-right-content',
							intro: '<b style=\"font-size:20px\">Ubah Parameter</b><br/><br/>Ubah <b>sumbu X</b> dan <b>sumbu Y</b> visualisasi',
							position: 'left'
						},
						{
							element: '#relation',
							intro: "<b style=\"font-size:20px\">Ubah Relasi</b><br/><br/>Ubah relasi visualisasi (panah)<br/> Relasinya sebagai berikut : " + data,
							position: 'top'
						},
						{	element: '#mode_zoom',
							intro: "<b style=\"font-size:20px\">Ubah Mode Pan</b><br/><br/>Ubah mode zoom<br/> Breadcrumbs atau Fisheye + Semantic",
							position: 'top'
						},
						{
							element: '#mode_pan',
							intro: "<b style=\"font-size:20px\">Ubah Mode Pan</b><br/><br/>Ubah mode pan<br/> Linier atau Distorsi",
							position: 'top'
						},
						{
							intro: "<b style=\"font-size:20px\">Relasi</b><br/><br/>Relasi digambarkan dengan <b>panah</b> yang memiliki kepala dan ekor panah. Paper pada <b>kepala panah</b> menunjukkan penelitian yang <b>lebih baik</b> atau <b>mengutip (citasi)</b> dari paper yang terdapat pada ekor (sumber), sementara <b>ekor panah</b> menunjukkan penelitian yang <b>lebih buruk</b> atau merupakan <b>sumber citasi</b>. Misal pada relasi citasi, paper pada ekor panah menunjukkan paper tersebut merujuk ke paper yang memiliki kepala panah"
						},
						{
							intro: "<b style=\"font-size:20px\">Zoom Data</b><br/><br/>Angka pada lingkaran menunjukkan <b>jumlah paper</b> pada suatu kordinat. Untuk data yang <b>lebih dari satu</b>, pengguna dapat melakukan <b>zoom</b> data dengan melakukan <b>klik pada lingkaran</b>. Zoom bertujuan untuk melihat informasi yang terkadung dengan lebih rinci."         
						},
						{
							intro: "<b style=\"font-size:20px\">Pengelompokan Data</b><br/><br/>Jika dilakukan zoom data, akan ditampilkan lingkaran berupa pengelompokan dari data yang sebelumnya dipilih. Pada mode zoom <b>Breadcrumbs</b>, pengelompokan <b>view baru</b>. Pada mode zoom <b>Fisheye + Semantic</b> pengelompokan ditampilkan pada <b>view yang sama</b> untuk efisiensi"
						},
						{
							intro: "<b style=\"font-size:20px\">Navigasi Level Breadcrumbs</b><br/><br/><img id=\"home\" src=\"<?php echo Yii::app()->request->baseUrl; ?>/images/breadcrumb.png\" height=\"30\" style=\"float:left;margin-right:10px;margin-bottom:10px\"></img>Untuk kembali ke data sebelumnya pengguna dapat melakukan klik pada <b><i>breadcrumb</i></b>. Untuk kembali ke peta penelitian, pengguna dapat melakukan klik pada <b>icon rumah (home)</b>"
						},
						{
							intro: "<b style=\"font-size:20px\">Navigasi Level Fisheye + Semantic</b><br/><br/>Untuk kembali ke data sebelumnya pengguna dapat melakukan klik pada <b>lingkaran yang baru saja dipilih sebelumnya</b> (ditandai dengan adanya border).</b>"
						}
					]
				});
				
				// Memulai help
				// intro.start();
				
				$(".introjs-button introjs-nextbutton").click(function(){
					intro.setOption('doneLabel', 'Lihat zooming').start().oncomplete(function() {
						$( "#3" ).trigger( "click" );
					});
				});
			}
			
			if(userID == "") {
				$('#save_paper').css("display","none");
				$('#planarity_paper').css("display","none");
			} else {
				$('#save_paper').css("display","inline");
				$('#planarity_paper').css("display","inline");
			}
		</script>
 
		<!-- Fitur untuk mengubah parameter pada sumbu x dan sumbu y -->
		<div class="sub-right-content" data-step="3" data-intro="Ubah sumbu X dan sumbu Y visualisasi">
			<!-- Header untuk menampilkan parameter yang dapat diubah -->
			<div class="sub-heading">Ubah Parameter</div>
				 
			<!-- Sumbu X -->
			<div>Sumbu X</div>
				<div class="dropdown">
					<?php
						echo CHtml::dropDownList('sumbuX', '', Chtml::listData(MetadataPenelitian::model()->findAllByAttributes(array('flag'=>array('1')), 'deskripsi <> \'Tahun Publikasi\''), 'deskripsi', 'deskripsi'), array(
						'ajax' => array(
						'type'=>'POST', //request type
						'url'=>CController::createUrl('metadataPenelitian/changeDropDown'), //url to call.
						//Style: CController::createUrl('currentController/methodToCall')
						'update'=>'#sumbuY', //selector to update
						//'data'=>'js:javascript statement' 
						//leave out the data key to pass all form values through
						'data'=>array('sumbuX' => 'js:this.value','sumbuYselected' => 'js:$(\'#sumbuY\').val()')
						/*
						'success' => "js:function(data)
						{
						alert(data);
						}",*/
					), 'class'=>'dropdown-style'));
					?>
				</div>
 
			<!-- Sumbu Y -->
			Sumbu Y
			<div class="dropdown">
				<?php
					echo CHtml::dropDownList('sumbuY', '', Chtml::listData(MetadataPenelitian::model()->findAllByAttributes(array('flag'=>array('1')), 'deskripsi <> \'Domain Data\''), 'deskripsi', 'deskripsi'), array(
					'ajax' => array(
					'type'=>'POST', //request type
					'url'=>CController::createUrl('metadataPenelitian/changeDropDown'), //url to call.
					//Style: CController::createUrl('currentController/methodToCall')
					'update'=>'#sumbuX', //selector to update
					//'data'=>'js:javascript statement' 
					//leave out the data key to pass all form values through
					'data'=>array('sumbuY' => 'js:this.value','sumbuXselected' => 'js:$(\'#sumbuX\').val()')
					/*
					'success' => "js:function(data)
					{
					alert(data);
					}",*/
					), 'class'=>'dropdown-style'));
				?>
			</div>
		</div>
 
		<!-- Fitur untuk mengubah parameter relasi -->
		<div id="relation" class="sub-right-content" data-step="4">
			<div class="sub-heading">Ubah Relasi</div>
				<div class="dropdown">
					<?php
						echo CHtml::dropDownList('edge', '', Chtml::listData(MetadataRelasi::model()->findAll(),'deskripsi', 'deskripsi'), array(
						'ajax' => array(
						'type'=>'POST', //request type
						'url'=>CController::createUrl('metadataPenelitian/changeDropDown'), //url to call.
						//Style: CController::createUrl('currentController/methodToCall')
						'update'=>'#edge', //selector to update
						//'data'=>'js:javascript statement' 
						//leave out the data key to pass all form values through
						'data'=>array('edge' => 'js:this.value','edgeSelected' => 'js:$(\'#edge\').val()')
						/*
						'success' => "js:function(data)
						{
						alert(data);
						}",*/
						), 'class'=>'dropdown-style'));
					?>
				</div>
		</div>

		<!-- Fitur untuk mengubah mode zooming -->
		<div id="zooming" class="sub-right-content">
			<div class="row" style="padding-left: 15px;">
			  	<div class="col-md-7">
			  		<div class="sub-heading">Mode Zoom</div>
			  	</div>
			  	<div class="col-md-2">
			  	<!-- <a href="#helpZooming" class="btn btn-primary btn-xs" style="background-color: #72aed0; border-color: #ffffff; margin-left: -20px;">
			  		Help
				</a> -->
				</div>
			</div>
			<div class="dropdown">
				<?php
					echo CHtml::dropDownList('mode_zoom', '', array('Fisheye' => 'Fisheye + Semantic', 'Breadcrumbs' => 'Breadcrumbs'), array(
					'ajax' => array(
					'type'=>'POST', //request type
					'url'=>CController::createUrl('metadataPenelitian/changeDropDown'),
					'update' => '#mode_zoom',
					'data'=>array('mode_zoom' => 'js:this.value', 'zoomSelected'=>'js:$(\'#mode_zoom\').val()')
				), 
				'class'=>'dropdown-style'));
				?> 
			</div> 
		</div>

		<!-- Fitur untuk mengubah mode panning -->
		<div id="pan" class="sub-right-content">
			<div class="row" style="padding-left: 15px;">
			  	<div class="col-md-6">
			  		<div class="sub-heading">Mode Pan</div>
			  	</div>
			  	<div class="col-md-3">
				  	<!-- <a href="#helpPanning" class="btn btn-primary btn-xs" style="background-color: #72aed0; border-color: #ffffff; margin-left: -4px;">
				  		Help
					</a> -->
				</div>
			</div>
			<div class="dropdown">
				<?php
					echo CHtml::dropDownList('mode_pan','',array('Distorsi' => 'Distorsi','Linier' => 'Linier'),array(
					'ajax' => array(
					'type'=>'POST', //request type
					'url'=>CController::createUrl('metadataPenelitian/changeDropDown'),
					'update' => '#mode_pan',
					'data'=>array('mode_pan' => 'js:this.value','panSelected'=>'js:$(\'#mode_pan\').val()')
					), 
					'class'=>'dropdown-style'));
				?> 
			</div>
		</div>
	</div>
 
	<!-- Tampilan di sebelah kiri, yaitu peta penelitian -->
	<div class="left-content" style="width:80%">
		<div id="Help zoom" style="margin-left: 150px; color: #3B5998;">
			<div class="helpPan alertHelp alert-warning"> Click on <b>map area</b> and drag it to desired position <b>or</b> drag the <b>box in overview map</b> to pan.</div>
			<div class="textInfo alertHelp alert-warning" style="margin-top:-37px;"> Press <b>Ctrl key</b> + move the <b>cursor</b> to pan. </div>
		</div>
		<img id="home" src="<?php echo Yii::app()->request->baseUrl; ?>/images/home.png" height="40" style="display:none; float:left; margin-right:10px"></img>
		<div id="sequence" style="display:none;"></div>
		<button id="reset" style="width:110px; margin-bottom: 10px;" class="btn btn-primary">Reset Pan</button>
		<!-- Container untuk zoom menggunakan breadcrumb pada level 0 -->
		<!-- <p id="chart"> -->
			<svg class="chart" id="chart"></svg>
		<!-- </p> -->
	</div>
			
	<!-- Container untuk zoom menggunakan breadcrumb pada level 1 dan level 2 -->
	<svg class="svg" id="svg" widht="0" height="500" style="display:none;">
		<!-- <g transform="translate(0,10)scale(1,1)" style="stroke-width: 1px;"> -->
			<div id="circle_packing" style="position:absolute; z-index:1; margin-left:-700px; margin-top:25px; top:100px; display:none;">
				<svg class="circle_packing" height="423" width="423"></svg>
			</div>
		<!-- </g> -->
	</svg>
 
	<!-- Inisialisasi peta penelitian -->
	<script id="scriptInit" type="text/javascript">
		$('select[name^="sumbuX"] option[value="' + defaultX + '"]').attr("selected", "selected");
		$('select[name^="sumbuY"] option[value="' + defaultY + '"]').attr("selected", "selected");
		$('select[name^="edge"] option[value="' + defaultEdge + '"]').attr("selected", "selected");
		$('select[name^="mode_zoom"] option[value="' + defaultZoom + '"]').attr("selected", "selected");
		$('select[name^="mode_pan"] option[value="'+defaultPan+'"]').attr("selected","selected");
		
		var nodes = {};
		 
		var margin = { top: 10, right: 30, bottom: 40, left: 150 },
		width = 950 - margin.left - margin.right,
		height = 510 - margin.top - margin.bottom;
		 
		if ($("#mode_pan option:selected").text()=='Linier'){
			var x = d3.scale.ordinal()
			.rangeRoundBands([0, width], .1);

			var y = d3.scale.ordinal()
			.rangeRoundBands([height, 0], .1);
		}
		else{
			var x = d3.fisheye.ordinal()
			.rangeRoundBands([0, width], .1);

			var y = d3.fisheye.ordinal()
			.rangeRoundBands([height, 0], .1);
		}
 
		var xAxis = d3.svg.axis()
			.scale(x)
			.outerTickSize(0)
			.orient("bottom");

		var yAxis = d3.svg.axis()
			.scale(y)
			.outerTickSize(0)
			.orient("left");
 
		var chart = d3.select(".chart")
		.attr("width", width + margin.left + margin.right)
		.attr("height", 515)
		.append("g")
		.attr('class','wrapper map')
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")");
		 
		var parameter;   
		// parameter = "8,10,11,12,13,14,15,16,17,18,19";
		parameter = "7,8,10,11,12,13,14,15,16,17,18,19,54,55,56,67,68,69,70,71,72,151,152,153,154,155,157,158,159,160,168,170,174,175";
				 
		var force = d3.layout.force();
		var sumbuX;
		var sumbuY;
		var pack = d3.layout.pack().padding(2).size([200,200]).value(function(d) {
			// console.log("d.name: " + d.name);
			return d.name.length;
		});
		var data;
		var b = {
			w: 75, h: 30, s: 3, t: 10
		};  
 
		chart.append("g")
		.attr("class", "x axis")
		.attr("transform", "translate(0," + height + ")")
		.call(xAxis);
 
		chart.append("g")
		.attr("class", "y axis")
		.attr("transform", "translate(0,0)")
		.call(yAxis);

		chart.append('rect')
			.attr('class', 'background')
			.attr('pointer-events', 'all')
			.style('cursor','-webkit-grab')
			.attr('fill', 'none')
			.attr('height', height)
			.attr('width', width);

		var wrapperInner = chart.append('g')
			.attr('class','wrapper inner')
			.attr('clip-path','url(#wrapperClipPath)')
			.attr("transform", "translate(" + 0 + "," + 0 + ")"); 

		wrapperInner.append("rect")
			.attr("class", "background")
			.attr("width", width)
			.style('fill','none')
			.attr("height", height);

		var panCanvas = wrapperInner.append("g")
			.attr("class", "panCanvas")
			.attr("width", width)
			.attr("height", height)
			.attr("transform", "translate(0,0)");

		panCanvas.append("rect")
			.attr("class", "background")
			.attr("width", width+385)
			.style('fill','none')
			.attr("height", height+230);

		d3.select('.chart').append('rect')
			.attr('class', 'block')
			.attr('fill', 'white')
			.attr('height', 100)
			.attr('width', 60)
			.attr("transform", "translate(920,460)");

		//menampung elemen yang bisa di-pan
		var svg1 = panCanvas.append('svg')
			    .attr('height', height+230)
			    .attr('width', width+385);
			    
		svg1.append('g').attr('class', 'draggable');
		
		var canvas = d3.select('.chart');

		var defs = canvas.append('defs');
		
		defs.append("clipPath")
			.attr("id", "wrapperClipPath")
			.attr("class", "wrapper clipPath")
			.append("rect")
			.attr("class", "background")
			.attr("width", width)
			.attr("height", height);
				
		defs.append("clipPath")
			.attr("id", "overviewClipPath")
			.attr("class", "overview clipPath")
			.attr("width", width)
			.attr("height", height)
			.append("rect")
			.attr("class", "background")
			.attr("width", width)
			.attr("height", height);
				
		var filter = defs.append("svg:filter")
			.attr("id", "overviewDropShadow")
			.attr("x", "-20%")
			.attr("y", "-20%")
			.attr("width", "150%")
			.attr("height", "150%");

		filter.append("svg:feOffset")
			.attr("result", "offOut")
			.attr("in", "SourceGraphic")
			.attr("dx", "1")
			.attr("dy", "1");

		filter.append("svg:feColorMatrix")
			.attr("result", "matrixOut")
			.attr("in", "offOut")
			.attr("type", "matrix")
			.attr("values", "0.1 0 0 0 0 0 0.1 0 0 0 0 0 0.1 0 0 0 0 0 0.5 0");

		filter.append("svg:feGaussianBlur")
		   .attr("result", "blurOut")
		   .attr("in", "matrixOut")
		   .attr("stdDeviation", "10");

		filter.append("svg:feBlend")
		   .attr("in", "SourceGraphic")
		   .attr("in2", "blurOut")
		   .attr("mode", "normal");
		var overviewRadialFill = defs.append("radialGradient")
			.attr({
				id:"overviewGradient",
				gradientUnits:"userSpaceOnUse",
				cx:"500",
				cy:"500",
				r:"400",
				fx:"500",
				fy:"500"
			});
		overviewRadialFill.append("stop")
			.attr("offset", "0%")
			.attr("stop-color", "#FFFFFF");
		overviewRadialFill.append("stop")
			.attr("offset", "40%")
			.attr("stop-color", "#EEEEEE");
		overviewRadialFill.append("stop")
			.attr("offset", "100%")
			.attr("stop-color", "#E0E0E0");
 
		// Hitung x asal
		function hitungX(sourcex, sourcey, targetx, targety, r) {
			var miring = Math.sqrt(Math.pow((targetx - sourcex), 2) + Math.pow((targety - sourcey), 2));
			return ((targetx * r - sourcex * r + miring * sourcex) / miring);
		}
		 
		// Hitung x tujuan
		function hitungX2(sourcex, sourcey, targetx, targety, r) {
			var miring = Math.sqrt(Math.pow((sourcex - targetx), 2) + Math.pow((sourcey - targety), 2));
			return ((targetx * miring - targetx * r - sourcex * miring + sourcex * r) / miring) + sourcex;
		}
 
		// Fungsi untuk menggambar kembali tampilan sesuai dengan parameter yang dipilih
		function redraw(dataString) {
			var rlink = new Array();
			d3.selectAll("circle").remove();
			d3.selectAll("line").remove();
			d3.selectAll(".label2").remove();
			d3.selectAll(".link").remove();

			data2 = JSON.parse(dataString); // Parse data dari basis data ke dalam bentuk JSON dan
			 
			data = data2.data3; // Ambil data dengan tag "data3" (berupa array of nodes)
 
			data.nodes = getChildren(data.nodes); // Ambil anak-anak (tag "children") dari data sebelumnya (array of nodes)

			// data.nodes.forEach(function(d) {
			// 	d.x = x(d.sumbu_x)
			// 	+ (x.rangeBand() / 2);
			// 	d.y = y(d.sumbu_y)
			// 	+ (y.rangeBand() / 2);
			// });

			// // x(d.source.sumbu_x)

			console.log("data", data);
 
			// Setting data untuk link, source dan targetnya ud data node
			if(data.links.length != 0) {
				var counter_rlink;
				counter_rlink = 0;
				var rlinks = new Array(data.links.length);
				for(var i = 0; i < data.links.length; i++) {
					var j, k, l, m;
					j = 0; k = 0;
					 
					var sudah_ketemu; sudah_ketemu = 0;
					while(data.nodes.length > j && !sudah_ketemu) {
						if(data.nodes[j].id.length == 1 && data.links[i].source != data.nodes[j].id[0]) {
							j++;                
						}
						else if(data.nodes[j].id.length == 1 && data.links[i].source == data.nodes[j].id[0]) {
							sudah_ketemu = 1;
						}
						else {
							l = 0;
							 
							while(data.nodes[j].id.length > l && data.links[i].source != data.nodes[j].id[l]) { // 3>0 && 1!=1
								l++;
							}
 
							if(data.nodes[j].id.length < l || data.links[i].source != data.nodes[j].id[l]) {
								j++;
							}
							else if (data.nodes[j].id.length > l && data.links[i].source == data.nodes[j].id[l]) {
								sudah_ketemu = 1;
							}
						}
					}
					 
					sudah_ketemu = 0;
					 
					while(data.nodes.length > k && !sudah_ketemu) {
						// console.log(data.nodes[k]);
						if(data.nodes[k].id.length == 1 && data.links[i].target != data.nodes[k].id[0]) {
							k++;
						}
						else if (data.nodes[k].id.length == 1 && data.links[i].target == data.nodes[k].id[0]) {
							sudah_ketemu = 1;
						}
						 
						else {
							m = 0;
							 
							while(data.nodes[k].id.length > m && data.links[i].target != data.nodes[k].id[m]) {
								m++;
							}
							 
							if(data.nodes[k].id.length < m || data.links[i].target != data.nodes[k].id[m]) {
								k++;
							}
							else if(data.nodes[k].id.length > m && data.links[i].target == data.nodes[k].id[m]) {
								sudah_ketemu = 1;
							}
						}
					}
					 
					// Untuk melist semua kemungkinan apakah source dan target berada dalam 1 level atau tidak
					if(j < data.nodes.length && k < data.nodes.length && ((data.nodes[j].id.length == 1 && data.nodes[k].id.length == 1 && data.links[i].target == data.nodes[k].id && data.links[i].source == data.nodes[j].id) || (data.nodes[j].id.length > 1 && data.nodes[k].id.length > 1 && data.links[i].target == data.nodes[k].id[m] && data.links[i].source == data.nodes[j].id[l]) || (data.nodes[j].id.length == 1 && data.nodes[k].id.length > 1 && data.links[i].target == data.nodes[k].id[m] && data.links[i].source == data.nodes[j].id) ||(data.nodes[j].id.length > 1 && data.nodes[k].id.length == 1 && data.links[i].target == data.nodes[k].id && data.links[i].source ==data.nodes[j].id[l]))) {
						 
						rlink[counter_rlink] = new Array();
						rlink[counter_rlink].source = data.nodes[j];
						 
						rlink[counter_rlink].target = data.nodes[k];
						counter_rlink++;
					} else {}
				}
			}
			console.log("rlink", rlink);
			 
			var formatxAxis = d3.format('.0f');
			var margin = {top: 10, right: 30, bottom: 30, left: 50};
			var width = 850 - margin.left - margin.right;
			var height = 500 - margin.top - margin.bottom;
			var x, y;
			var minimum;
			 
			// Sorting sumbu X dan Y
			// Sorting angka
			
			// Fungsi apabila dipilih parameter pada sumbu x dengan nilai "Tahun Publikasi"
			if ($("#sumbuX option:selected").text() == 'Tahun Publikasi') {
				// data.nodes = data.nodes;
				// var i;
				for(var i = 0; i < data.nodes.length; i++) {
					data.nodes[i].sumbu_x = parseInt(data.nodes[i].sumbu_x);
				}
 
				if ($("#mode_pan option:selected").text()=='Linier'){
					x = d3.scale.ordinal()			
						.domain(data.nodes.sort(function(a, b){  return d3.ascending(a.sumbu_x, b.sumbu_x)}).map(function(d) { return d.sumbu_x; }))
						.rangeRoundBands([0, width+385], .1);
				}
				else{
					x = d3.fisheye.ordinal()			
						.domain(data.nodes.sort(function(a, b){  return d3.ascending(a.sumbu_x, b.sumbu_x)}).map(function(d) { return d.sumbu_x; }))
						.rangeRoundBands([0, width], .1);
				}
			}
			 
			// Sorting huruf
			else {
				for(i = 0; i < data.nodes.length; i++) {
					data.nodes[i].sumbu_x = data.nodes[i].sumbu_x.charAt(0).toUpperCase() + data.nodes[i].sumbu_x.slice(1);
				}
				if ($("#mode_pan option:selected").text()=='Linier'){
					x = d3.scale.ordinal()			
						.domain(data.nodes.sort(function(a, b){  return d3.ascending(a.sumbu_x, b.sumbu_x)}).map(function(d) { return d.sumbu_x; }))
						.rangeRoundBands([0, width+385], .1);
				}
				else{
					x = d3.fisheye.ordinal()			
						.domain(data.nodes.sort(function(a, b){  return d3.ascending(a.sumbu_x, b.sumbu_x)}).map(function(d) { return d.sumbu_x; }))
						.rangeRoundBands([0, width], .1);
				}
			}
			
			// Fungsi apabila dipilih parameter pada sumbu y dengan nilai "Tahun Publikasi"
			if ($("#sumbuY option:selected").text() == 'Tahun Publikasi') {
				// y = d3.scale.linear()
				// .domain([d3.min(data.nodes.map(function(d) {return d.sumbu_y; }))-5, d3.max(data.nodes.map(function(d) {return d.sumbu_y; }))])
				// .range([0, height]);
				
				// Ubah angka string menjadi angka numeric
				for(var i = 0; i < data.nodes.length; i++) {
					data.nodes[i].sumbu_y = parseInt(data.nodes[i].sumbu_y);
				}
 
				if ($("#mode_pan option:selected").text()=='Linier'){
					y = d3.scale.ordinal()
						.rangeRoundBands([height+230, 0], .1)
						.domain(data.nodes.sort(function(a, b){  return d3.ascending(a.sumbu_y, b.sumbu_y)}).map(function(d) { return d.sumbu_y; }));
				}
				else{
					y = d3.fisheye.ordinal()
						.rangeRoundBands([height, 0], .1)
						.domain(data.nodes.sort(function(a, b){  return d3.ascending(a.sumbu_y, b.sumbu_y)}).map(function(d) { return d.sumbu_y; }));
				}
			} else {
				for(i = 0; i < data.nodes.length; i++) {
					data.nodes[i].sumbu_y = data.nodes[i].sumbu_y.charAt(0).toUpperCase() + data.nodes[i].sumbu_y.slice(1);
				}
				 
				if ($("#mode_pan option:selected").text()=='Linier'){
					y = d3.scale.ordinal()
						.rangeRoundBands([height+230, 0], .1)
						.domain(data.nodes.sort(function(a, b){  return d3.ascending(a.sumbu_y, b.sumbu_y)}).map(function(d) { return d.sumbu_y; }));
				}
				else{
					y = d3.fisheye.ordinal()
						.rangeRoundBands([height, 0], .1)
						.domain(data.nodes.sort(function(a, b){  return d3.ascending(a.sumbu_y, b.sumbu_y)}).map(function(d) { return d.sumbu_y; }));
				}
			}
			 
			// X, Y
			var xAxis, yAxis;
			if(y.rangeBand() > x.rangeBand()) {
				minimum = x.rangeBand();
			} else {
				minimum = y.rangeBand();
			}
			 
			var start;
			if((minimum / 2) < 10) {
				// alert("Data yang dimasukkan terlalu banyak! Kurangi data");
				if(document.URL.indexOf("#") >= 0) {
					var location = document.URL.split("#");
					document.location.href = location[0] + '#AddPaper';
				} else {
					document.location.href = document.URL + '#AddPaper';
				}
				 
				// start = minimum / 2 - 1;
			} else {
				if(d3.min(data.nodes.map(function(d) {return d.id.length; })) != d3.max(data.nodes.map(function(d) { return d.id.length; }))) {
					start = 15;
				} else {
					start = minimum / 2;
				}
			}
			
			var r = d3.scale.linear()
				.domain([d3.min(data.nodes.map(function(d) {return d.id.length; })), d3.max(data.nodes.map(function(d) { return d.id.length; }))])
				.range([start, minimum / 2]);

			xAxis = d3.svg.axis().scale(x).outerTickSize(0).orient("bottom").tickFormat(function(d) {
				if(d.length > minimum / 10) {
					chart.selectAll(".x.axis").selectAll(".tick").each(function( index ) {
						$(this).tipsy({ 
							gravity: 'n', 
							html: true,
							delayIn: 1000,
							title: function() {
								return "<span style=\"font-size:12px\">" + index + "</span>";
							}
						});
					});
					d = d.substr(0, minimum / 10); return d + "..."
				} else {
					return d;
				}
			});
 
			yAxis = d3.svg.axis().scale(y).outerTickSize(0).orient("left").tickFormat(function(d) {
				if(d.length > 10) {
					chart.selectAll(".y.axis").selectAll(".tick").each(function( index ) {
						$(this).tipsy({ 
							gravity: 'e', 
							html: true,
							delayIn: 1000,
							title: function() {
								return "<span style=\"font-size:12px\">" + index + "</span>";
							}
						});
					});
					 
					d = d.substr(0, 10); return d+"..."
				} else {
					return d;
				}
			});
			
			chart.selectAll("g.y.axis")
			.call(yAxis);

			chart.selectAll("g.x.axis")
			.call(xAxis);
			
			var string = new Array();
			
			var keyword = new Array(data.nodes.length);
			// keyword[0] = [];
			for(i = 0; i < data.nodes.length; i++) {
				// string = data.nodes[i].keyword[0].split(" ");
				keyword[i] = new Array();
				keyword[i] = data.nodes[i].keyword[0].replace(/ /g,"\n");;
				data.nodes[i].keyword = [];
				// data.nodes[i].keyword.splice(0, 1, data.nodes[i].keyword[0].split(" "));
				$.merge(data.nodes[i].keyword, keyword[i]);
			}

			// Ubah label pada sumbu X dan Y
			if($("#sumbuY option:selected").text().indexOf(' ') >= 0) {
				chart.append("text")
				.attr("class", "sumbuYlabel")
				.attr("text-anchor", "middle")  // this makes it easy to centre the text as the transform is applied to the anchor
				.attr("transform", "translate(" + -115 + "," + ((height / 2) - 15) + ")")  // text is drawn off the screen top left, move down and out and rotate
				.text($("#sumbuY option:selected").text().split(' ')[0]);

				chart.append("text")
				.attr("class", "sumbuYlabel")
				.attr("text-anchor", "middle")  // this makes it easy to centre the text as the transform is applied to the anchor
				.attr("transform", "translate(" + -115 + "," + (height / 2) + ")")  // text is drawn off the screen top left, move down and out and rotate
				.text($("#sumbuY option:selected").text().split(' ')[1]);

				chart.append("text")
				.attr("class", "sumbuXlabel")
				.attr("text-anchor", "middle")  // this makes it easy to centre the text as the transform is applied to the anchor
				.attr("transform", "translate(" + (width / 2) + "," + (height + 45) + ")")  // centre below axis
				.text($("#sumbuX option:selected").text());
			} else {
				chart.append("text")
				.attr("class", "sumbuYlabel")
				.attr("text-anchor", "middle")  // this makes it easy to centre the text as the transform is applied to the anchor
				.attr("transform", "translate(" + -115 + "," + (height / 2) + ")")  // text is drawn off the screen top left, move down and out and rotate
				.text($("#sumbuY option:selected").text());
 
				chart.append("text")
				.attr("class", "sumbuXlabel")
				.attr("text-anchor", "middle")  // this makes it easy to centre the text as the transform is applied to the anchor
				.attr("transform", "translate(" + (width / 2) + ","+(height + 45) + ")")  // centre below axis
				.text($("#sumbuX option:selected").text());
			}
 
			var g1 = chart.select(".draggable").selectAll("g.circle").data(data.nodes);
			// console.log(JSON.stringify(g1));
 
			// chart.selectAll("g.circle").data(data.nodes).enter().append("circle")
 
			// Add breadcrumb and label for entering nodes.
			var entering2 = g1.enter().append("svg:g").classed("lingkaran", true);

		if($("#mode_pan option:selected").text() == 'Linier'){

			entering2.append("svg:circle")
			.classed("node", true)
			.attr("id", function(d, i) {
				// if(d.id.length > 1) { return d.id.length; }
				return "circle-" + i;
			})
			.attr("r", function(d) { return r(d.id.length); })
			.style("fill", "#3B5998");
 
			entering2.append("svg:text")
			.classed("label2", true)
			.attr("dy", function(d){return d.id.length + 3 + "px";})
			.text(function(d) {return d.id.length;})
			.attr("font-size", "14px")
			.style("fill","white");
 		}
 		else{
 			entering2.append("svg:circle")
			.classed("node", true)
			.attr("id", function(d, i) {
				// if(d.id.length > 1) { return d.id.length; }
				return "circle-" + i;
			})
			.attr("r", function(d) {
				// Mengatur jari-jari lingkaran
				var rmax = 30;
				var xFeye, yFeye, a, b;
				xFeye = (x(d.sumbu_x) + (x.rangeBand() / 2));
				yFeye = (y(d.sumbu_y) + (y.rangeBand() / 2));
				a = Math.abs(rmax-(Math.abs(60-xFeye)/rmax));
				b = Math.abs(rmax-(Math.abs(60-yFeye)/rmax));
				if (a<b) {return a; }
				else { return b; }
			})
			.style("fill", "#3B5998");
 
			entering2.append("svg:text")
			.classed("label2", true)
			.style("fill","white")
			.attr("dy", function(d){return d.id.length + 3 + "px";})
			.text(function(d) {return d.id.length;})
			.attr("font-size", function(d){
				//jari-jari pada fisheye view
				var rmax = 30, fontmax = 14;
				var xFeye, yFeye, a, b, r;
				xFeye = (x(d.sumbu_x) + (x.rangeBand() / 2));
				yFeye = (y(d.sumbu_y) + (y.rangeBand() / 2));
				a = Math.abs(rmax-(Math.abs(150-xFeye)/rmax));
				b = Math.abs(rmax-(Math.abs(150-yFeye)/rmax));
				if (a<b) { r=a; }
				else { r=b; }
				//ukuran font text relatif terhadap jari-jari lingkaran
				return Math.abs(fontmax-(r+8));
			});
 		}
			entering2.attr("transform", function(d) {
				return "translate(" +
				(x(d.sumbu_x) + (x.rangeBand() / 2))
				+ ", "+
				(y(d.sumbu_y) + (y.rangeBand() / 2))
				+")";
			})
			.on("click", function(d) {
				if(d.children.length == 1) {
					if(document.URL.indexOf("#") >= 0) {
						var location = document.URL.split("#");
						document.location.href = location[0] + '#ShowDetailPaper';
					} else {
						document.location.href = document.URL + '#ShowDetailPaper';
					}
 
					var maxKey,maxValue;
					maxKey = 0;
					maxValue = 0;
 
					$.each(d.children[0], function(key, value) {
						if(maxKey < key.length) {
							maxKey = key.length;
						}
						if(maxValue < value.length) {
							maxValue = value.length;
						}
					});
 
					$.each(d.children[0], function(key, value) {
						if(key == "id" || key == "creater") {}
						else {
							$( "#popup-content" ).append( "<li><label style=\"width:" + maxKey * 8 + "px\">" + key + "</label><label style=\"width:10px\"> : </label></li>" );
							if(value=="") {}
								else {
									$( "#popup-content" ).append('<span class="detail-content">' + value + '</span>');
								}
							}
						});
 
					$('a[href="#close"]').click(function() {
						$( "#popup-content" ).empty();
						$( "#map_name" ).val('');
					});
 
					$('a[href="#x"]').click(function() {
						$( "#popup-content" ).empty();
						$( "#map_name" ).val('');
					});                 
				} else {
					transition(d, chart, x(d.sumbu_x) + (x.rangeBand() / 2), y(d.sumbu_y) + (y.rangeBand() / 2)); 
				}
			})
		
			// Untuk hover paper pada level 0 dengan jumlah paper 1
			$("svg circle").each(function(d, i) {				
				if(g1[0][d].__data__.children.length == 1) {
					$(g1[0][d]).tipsy({ 
						gravity: 'w', 
						html: true,
						delayIn: 1000,
						title: function() {
							return "<span style=\"font-size:13px\">" + this.__data__.children[0].judul + "</span><br>Peneliti : " + this.__data__.children[0].peneliti;
						}
					});
				}
			}); 

			data.nodes.forEach(function(d) {
				d.x = x(d.sumbu_x)
				+ (x.rangeBand() / 2);
				d.y = y(d.sumbu_y)
				+ (y.rangeBand() / 2);
			});

			// x(d.source.sumbu_x)

			if($("#mode_pan option:selected").text() == 'Linier') {
				// Cari jumlah perpotongan garis
				function isIntersect(sourcex, sourcey, targetx, targety, sourcex2, sourcey2, targetx2, targety2){
					var point1A = sourcey - targety;
					var point1B = targetx - sourcex;
					var point1C = -(sourcex * targety - targetx *sourcey);
					var point2A = sourcey2 - targety2;
					var point2B = targetx2 - sourcex2;
					var point2C = -(sourcex2 * targety2 - targetx2 *sourcey2);

					var D = point1A * point2B - point1B * point2A;
					var Dx = point1C * point2B - point1B * point2C;
					var Dy = point1A * point2C - point1C * point2A;

					if (D != 0) {	
						var x = Dx/D;
						var y = Dy/D;
						
						// Jika perpotongan garis hanya diujung garis
						if ((x == sourcex || x == sourcex2 || x == targetx || x == targetx2) || (y == sourcey || y == sourcey2 || y == targety || y == targety2)) {
							return 0;
						} else {
							// Jika perpotongan garis di luar garis yang tergambar
							if (((x > sourcex && x < targetx) || (x > targetx && x < sourcex)) && ((x > sourcex2 && x < targetx2) || (x > targetx2 && x < sourcex2)) && ((y > sourcey && y < targety) || (y > targety && y < sourcey)) && ((y > sourcey2 && y < targety2) || (y > targety2 && y < sourcey2))) {
								// console.log("x = ", x);
								// console.log("y = ", y);
								return 1;
							} else {
								return 0;
							}
						}
					} else {
						return 0;
					}
				}

				var intersectIDs = new Array();
				var uniqueIntersectIDs = new Array();
				var intersectRlink = new Array();
				
				function sumIntersection(rlink){
					var intersect = 0;
					var counter = 0;
					// var counterunique = 0;
					for(var i = 0; i < rlink.length-1; i++) {
						for(var j = i+1; j < rlink.length; j++) {
							// console.log("i : ", i);
							// console.log("j : ", j);
							if (isIntersect((rlink[i].source.x), (rlink[i].source.y), (rlink[i].target.x), (rlink[i].target.y), (rlink[j].source.x), (rlink[j].source.y), (rlink[j].target.x), (rlink[j].target.y))){
								
								// // tes array unik ID
								// uniqueIntersectIDs[counterunique] = rlink[i].source.id[0];
								// counterunique++;
								// uniqueIntersectIDs[counterunique] = rlink[i].target.id[0];
								// counterunique++;

								// tes array of array ID
								var intersectID = {"rlink": i, "source_id": rlink[i].source.id[0], "target_id": rlink[i].target.id[0]};
								intersectIDs[counter] = intersectID;
								intersectRlink[counter] = i;
								counter++;

								// // tes array unik ID
								// uniqueIntersectIDs[counterunique] = rlink[j].source.id[0];
								// counterunique++;
								// uniqueIntersectIDs[counterunique] = rlink[j].target.id[0];

								// tes array of array ID
								// var intersectID = new Array(2);
								// intersectID[0] = rlink[j].source.id[0];
								// intersectID[1] = rlink[j].target.id[0];
								var intersectID = {"rlink": j, "source_id": rlink[j].source.id[0], "target_id": rlink[j].target.id[0]};
								intersectIDs[counter] = intersectID;
								intersectRlink[counter] = j;
								counter++;
								// counterunique++;

								//count intersect
								intersect++;
							}
						}
					}

					return intersect;
				}

				// Perpotongan garis hanya akan dicari jika linknya ada
				if(rlink.length != 0) {
					var sumIntersect = sumIntersection(rlink);
					console.log("Jumlah perpotongan garis = ", sumIntersect);
				}
				// Cari jumlah perpotongan garis selesai

				// console.log("intersectIDs : ", intersectIDs);
				// console.log("intersectRlink : ", intersectRlink);
				// console.log("unik intersectIDs : ", uniqueIntersectIDs);

				var planar_nodes = data.nodes.slice(0);
				// var unique = sortUnique(uniqueIntersectIDs.slice(0));


				function sortUnique(arr) {
					var temp = arr.slice(0);
				    temp.sort();
				    var last_i;
				    for (var i=0;i<temp.length;i++)
				        if ((last_i = temp.lastIndexOf(temp[i])) !== i)
				            temp.splice(i+1, last_i-i);
				    return temp;
				}

				Array.prototype.move = function (old_index, new_index) {
				    if (new_index >= this.length) {
				        var k = new_index - this.length;
				        while ((k--) + 1) {
				            this.push(undefined);
				        }
				    }
				    this.splice(new_index, 0, this.splice(old_index, 1)[0]);
				    return this;
				};

				// Mengubah urutan nodes
				function changeNodesOrder(nodes){
					while (sumIntersect != 2){
						for(var i=0; i<unique.length; i++){
							for(var j=0; j<planar_nodes.length; j++){
								planar_nodes.move(unique[i], j);
								if (sumIntersect == 2){
									break;
								}
							}
						}
					}
				}

				/////////////////////////////////////
				/// Change to grid representation ///
				/////////////////////////////////////
				
				// Bresenham algorithm to find array of point in a line
				function bresenhamAlgorithm (source, target) {
				    var coordinatesArray = new Array();
				    
				    // Translate coordinates
				    var x1 = source.x;
				    var y1 = source.y;
				    var x2 = target.x;
				    var y2 = target.y;

				    // Define differences and error check
				    var dx = Math.abs(x2 - x1);
				    var dy = Math.abs(y2 - y1);
				    var sx = (x1 < x2) ? 1 : -1;
				    var sy = (y1 < y2) ? 1 : -1;
				    var err = dx - dy;
				    
				    // Set first coordinates
				    coordinatesArray.push({"x" : x1, "y" : y1});
				    
				    // Main loop
				    while (!((x1 == x2) && (y1 == y2))) {
				      	var e2 = err << 1;
				      	if (e2 > -dy) {
					    	err -= dy;
					        x1 += sx;
				      	}
				      	if (e2 < dx) {
					        err += dx;
					        y1 += sy;
				      	}
				      	// Set coordinates
				      	coordinatesArray.push({"x" : x1, "y" : y1});
				    }
				    // Return the result
				    return coordinatesArray;
				}

				var coordinatesLine = new Array();
				var points = new Array();

				var counter_point = 0;

				for(var i=0; i<rlink.length; i++){

					// Masukan data koordinat garis 
					coordinatesLine.push(bresenhamAlgorithm(rlink[i].source, rlink[i].target));

					points[counter_point] = {"x" : rlink[i].source.x, "y" : rlink[i].source.y};
					counter_point++;
					points[counter_point] = {"x" : rlink[i].target.x, "y" : rlink[i].target.y};
					counter_point++;
				}

				// console.log("coordinate: ", coordinatesLine);

				// Urutkan 
				var temp_points = points.slice(0);
				var points_x_min = temp_points.sort(function(a, b){
				    if(a.x < b.x) return -1;
				    if(a.x > b.x) return 1;
				    return 0;
				});

				var temp_points = points.slice(0);
				var points_y_min = temp_points.sort(function(a, b){
				    if(a.y < b.y) return -1;
				    if(a.y > b.y) return 1;
				    return 0;
				});


				var xMin = points_x_min[0].x;
				var yMin = points_y_min[0].y;
				var xMax = points_x_min[points_x_min.length-1].x;
				var yMax = points_y_min[points_y_min.length-1].y;

				var grid_width = xMax/25 + 50;
				var grid_height = yMax/25 + 50;

				// console.log("grid_width : ", grid_width);
				// console.log("grid_height : ", grid_height);

				// make grid representation
				// var grid = new Array();
			 //    if (grid_height != null && grid_width != null){
			 //        // inisialisasi grid
			 //        for (var i=-5; i<grid_height; i++){
			 //            var row = new Array();
			 //            for (var j=-5; j<grid_width; j++){
			 //            	row[j] = 1;
			 //            }
			 //            grid[i] = row;
			 //        }
			 //    }

			    // console.log("grid:", grid);
			    // console.log("coordinate: ", coordinatesLine);

				////////////////////////////////////////////
				/// Change to grid representation selesai///
				////////////////////////////////////////////
			}

			


			// Panah dan garis hanya akan dibuat jika linknya ada
			if(rlink.length != 0) {
				// Untuk membuat panah
				var marker = chart.select(".draggable").selectAll("g.marker").data(data.links)
					.enter().append("svg:marker")
					.attr("id", function(d, i) { return i; })
					.attr("viewBox", "0 -5 10 10")
					.attr("refX", function(d) {
						if((y(d.target.value) == y(d.source.value)) && (x(d.target.sumbu_x) == x(d.source.sumbu_x))) {}
						 
						if(x(d.target.sumbu_x) > x(d.source.sumbu_x)) {
							return 10;
						} else {
							return 10;
						}           
					})
					.attr("refY", 0)
					.attr("markerWidth", 6)
					.attr("markerHeight", 6)
					.attr("orient", "auto")
					.append("svg:path")
					.attr("d", "M0,-5L10,0L0,5")
					.attr("fill","none")
					.attr("stroke","black");
				 
						

				if($("#mode_pan option:selected").text() == 'Linier' && sumIntersect > 0) {
					var planar_link = [];
					var count_nonplanar_link = 1; // untuk menghitung jumlah link yang tidak memiliki path planar

					var nonplanar_line;

					var max_change_order = 30;
					var change_order = 0;

					while (count_nonplanar_link != 0 && change_order != max_change_order){

				        // inisialisasi grid awal
				        var grid = new Array();
				        for (var i=0; i<grid_height; i++){
				            var row = new Array();
				            for (var j=0; j<grid_width; j++){
				            	row[j] = 1;
				            }
				            grid[i] = row;
				        }

				        

		   				planar_link = [];
		   				count_nonplanar_link = 0;

		   				console.log("ch", change_order);
		   				
		   				// ganti order array
		   				if (change_order != 0){
		   					var new_rlink = new_rlink_changed.slice(0);
		   					// console.log("link2", new_rlink);
		   				} else {
				        	var new_rlink = rlink.slice(0);
		   					var new_rlink_changed = rlink.slice(0);

		   					// console.log("link", new_rlink);
		   				}

			   			for (var i=0; i<new_rlink.length; i++){

							// for (var a=0; a<data.nodes.length; a++){
							// 	// if (a != i){
							// 		// value = 0 untuk grid berisi node
							// 		grid[Math.floor(data.nodes[a].y / 25)][Math.floor(data.nodes[a].x / 25)] = 0;
							// 		grid[Math.floor(data.nodes[a].y / 25)][Math.floor(data.nodes[a].x / 25)] = 0;
							// 	// }
							// }

							for (var a=0; a<data.nodes.length; a++){
								if (data.nodes[a].id[0] != new_rlink[i].source.id[0] && data.nodes[a].id[0] != new_rlink[i].target.id[0]){
									for (var b=Math.ceil(data.nodes[a].y / 25)-1; b<Math.ceil(data.nodes[a].y / 25)+1; b++){
										for (var c=Math.ceil(data.nodes[a].x / 25)-1; c<Math.ceil(data.nodes[a].x / 25)+1; c++){
											if (b>0 && c>0)
												grid[b][c] = 0;
										}
									}
								}
								// grid[Math.ceil(data.nodes[a].y / 25)][Math.ceil(data.nodes[a].x / 25)] = 0;
							}

							// Jika grid awal dan tujuan dianggap obstacle, ubah value grid jadi 1
							if (grid[Math.ceil(new_rlink[i].source.y / 25)][Math.ceil(new_rlink[i].source.x / 25)] == 0){
								// grid[Math.ceil(new_rlink[i].source.y / 25)][Math.ceil(new_rlink[i].source.x / 25)] = 1;
								for (var b=Math.ceil(new_rlink[i].source.y / 25)-1; b<Math.ceil(new_rlink[i].source.y / 25)+1; b++){
									for (var c=Math.ceil(new_rlink[i].source.x / 25)-1; c<Math.ceil(new_rlink[i].source.x / 25)+1; c++){
										if (b>0 && c>0)
											grid[b][c] = 1;
									}
								}
							}
							if (grid[Math.ceil(new_rlink[i].target.y / 25)][Math.ceil(new_rlink[i].target.x / 25)] == 0){
								// grid[Math.ceil(new_rlink[i].target.y / 25)][Math.ceil(new_rlink[i].target.x / 25)] = 1;
								for (var b=Math.ceil(new_rlink[i].target.y / 25)-1; b<Math.ceil(new_rlink[i].target.y / 25)+1; b++){
									for (var c=Math.ceil(new_rlink[i].target.x / 25)-1; c<Math.ceil(new_rlink[i].target.x / 25)+1; c++){
										if (b>0 && c>0)
											grid[b][c] = 1;
									}
								}
							}

							var graph = new Graph(grid, { diagonal: true });
							// var graph = new Graph(grid);

							var start = graph.grid[Math.ceil(new_rlink[i].source.y / 25)][Math.ceil(new_rlink[i].source.x / 25)];
							var end = graph.grid[Math.ceil(new_rlink[i].target.y / 25)][Math.ceil(new_rlink[i].target.x / 25)];

							var result = astar.search(graph, start, end);
							// console.log("result", result);
							console.log("start", start);

							var planar_point = [];

							if (result.length != 0){
								planar_point.push({"x" : new_rlink[i].source.x, "y" : new_rlink[i].source.y});
								for(var k=0; k<result.length-1; k++){
									planar_point.push({"x" : result[k].y * 25, "y" : result[k].x * 25});
								}
								planar_point.push({"x" : new_rlink[i].target.x, "y" : new_rlink[i].target.y});
								planar_link.push(planar_point);

								// for(var k=0; k<result.length; k++){
								// 	planar_point.push({"x" : result[k].y * 25, "y" : result[k].x * 25});
								// }
								// planar_link.push(planar_point);

								for (var l=0; l<result.length; l++){
							    	for (var m=result[l].x-1; m<result[l].x+1; m++){
							    		for (var n=result[l].y-1; n<result[l].y+1; n++){
							    			// console.log("m",m);
							    			// console.log("n",n);
											if (m>0 && n>0)
												grid[m][n] = 0;
								    	}
							    	}
							    	// grid[result[l].x][result[l].y] = 0;
								}

								// var graph = new Graph(grid);

								// var start = graph.grid[Math.ceil(new_rlink[i].source.y / 25)][Math.ceil(new_rlink[i].source.x / 25)];
								// var end = graph.grid[Math.ceil(new_rlink[i].target.y / 25)][Math.ceil(new_rlink[i].target.x / 25)];

								// var result = astar.search(graph, start, end);
								console.log("result", result);

								// var planar_point = [];

								// if (result.length != 0){
								// 	for (var l=0; l<result.length; l++){
								//     	for (var m=result[l].x-1; m<result[l].x+1; m++){
								//     		for (var n=result[l].y-1; n<result[l].y+1; n++){
								//     			// console.log("m",m);
								//     			// console.log("n",n);
								// 				if (m>0 && n>0)
								// 					grid[m][n] = 0;
								// 	    	}
								//     	}
								//     	// grid[result[l].x][result[l].y] = 0;
								// 	}
								// 	// console.log("i", i, "grid", grid);

								// 	// console.log("i", i);
								// 	// console.log("len", len);
								// }

								// for (var l=0; l<result.length; l++){
								// 	grid[result[l].y][result[l].x] = 0;
								// }

								
								// console.log("i", i, "grid", grid);


								// console.log("i", i);
								// console.log("len", len);
							} else {

								// console.log("i", i, "grid", grid);
								// console.log("start", start);
								// console.log("end", end);



								planar_point.push({"x" : new_rlink[i].source.x, "y" : new_rlink[i].source.y}, 
												  {"x" : new_rlink[i].target.x, "y" : new_rlink[i].target.y});
								planar_link.push(planar_point);

								// value = 0 untuk grid berisi node
								grid[Math.ceil(new_rlink[i].source.y / 25)][Math.ceil(new_rlink[i].source.x / 25)] = 0;
								grid[Math.ceil(new_rlink[i].target.y / 25)][Math.ceil(new_rlink[i].target.x / 25)] = 0;

								count_nonplanar_link++;
								nonplanar_line = i;
								console.log("np line:", nonplanar_line);

								new_rlink_changed.move(nonplanar_line,0);
								// console.log("new", new_rlink_changed);
							}
						}
						change_order++;
					}

					console.log("p", planar_link);

					var line_function = d3.svg.line()
	                    .x(function(d) { return d.x; })
	                    .y(function(d) { return d.y; })
	                    .interpolate("linear");

					for(var i=0; i<planar_link.length; i++){
						var link = chart.select('.draggable').selectAll("g.link").data(planar_link[i])
						.enter().append("path")
						.attr("d", line_function(planar_link[i]))
						.attr("stroke", "black")
	                    .attr("stroke-width", 1)
	                    .attr("fill", "none")
	                    .attr("class", "tes0")
	                    .classed("link", true)
	                    .attr("marker-end", function(d, i) { return "url(#" + i + ")"; });
					}

					// var dummy = [{"x" : 900, "y" : 280},  {"x" : 1080, "y" : 540}];
					// var link = chart.select('.draggable').selectAll("g.link").data(dummy)
					// 	.enter().append("path")
					// 	.attr("d", line_function(dummy))
					// 	.attr("stroke", "red")
	    //                 .attr("stroke-width", 3)
	    //                 .attr("fill", "none")
	    //                 .attr("class", "link")
	    //                 .attr("marker-end", function(d, i) { return "url(#" + i + ")"; });


				} else { // mode distorsi
					// (X1, Y1) koordinat asal
					// (X2, Y2) koordinat tujuan
					var link = chart.select(".draggable").selectAll("g.link").data(rlink)
					.enter().append("line")
					.attr("class", "tes0")
					.classed("link", true)
					.attr("x1", function(d) {
						if((y(d.target.sumbu_y) == y(d.source.sumbu_y)) && (x(d.target.sumbu_x) > x(d.source.sumbu_x))) {
							return x(d.source.sumbu_x)+ (x.rangeBand() / 2) + r(d.source.id.length); 
						}
						 
						// Garis horizontal jika lingkaran asal ada di kiri target
						else if ((y(d.target.sumbu_y) == y(d.source.sumbu_y)) && (x(d.target.sumbu_x) < x(d.source.sumbu_x))) {
							return x(d.source.sumbu_x) + (x.rangeBand() / 2) - r(d.source.id.length);
						}
						 
						// Garis vertical
						else if(x(d.target.sumbu_x) == x(d.source.sumbu_x)) {
							return x(d.source.sumbu_x) + (x.rangeBand() / 2);
						}
						 
						// Garis miring
						else {
							return hitungX((x(d.source.sumbu_x) + (x.rangeBand() / 2)),(y(d.source.sumbu_y) + (y.rangeBand() / 2)), (x(d.target.sumbu_x) + (x.rangeBand() / 2)), (y(d.target.sumbu_y) + (y.rangeBand() / 2)), r(d.source.id.length));
						}
					})
					.attr("y1", function(d) { 
						//garis horizontal
						if(y(d.target.sumbu_y) == y(d.source.sumbu_y)) {
							return y(d.source.sumbu_y) + (y.rangeBand() / 2);
						}
						 
						//garis vertical dengan lingkaran asal ada di atas target
						else if((x(d.target.sumbu_x) == x(d.source.sumbu_x)) && (y(d.target.sumbu_y) > y(d.source.sumbu_y))) {
							return (y(d.source.sumbu_y)+ (y.rangeBand() / 2) + r(d.source.id.length));
						}
						 
						//garis vertical dengan lingkaran asal ada di bawah target
						else if((x(d.target.sumbu_x) == x(d.source.sumbu_x)) && (y(d.target.sumbu_y) < y(d.source.sumbu_y))) {
							return (y(d.source.sumbu_y) + (y.rangeBand() / 2) - r(d.source.id.length));
						}
	 
						else {
							var miring = Math.sqrt(Math.pow(((x(d.source.sumbu_x) + x.rangeBand() / 2)-(x(d.target.sumbu_x) + x.rangeBand() / 2)), 2) + Math.pow(((y(d.source.sumbu_y)+y.rangeBand() / 2)-(y(d.target.sumbu_y) + y.rangeBand() / 2)), 2));
							return (y(d.source.sumbu_y) + y.rangeBand() / 2)-(((y(d.source.sumbu_y) + y.rangeBand() / 2)-(y(d.target.sumbu_y) + y.rangeBand() / 2)) * r(d.source.id.length) / miring);
						}
					})
					// Sama seperti diatas, hanya untuk lingkaran target
					.attr("x2", function(d) {
						if((x(d.target.sumbu_x) > x(d.source.sumbu_x)) && (y(d.target.sumbu_y) == y(d.source.sumbu_y))) {
							return x(d.target.sumbu_x) + (x.rangeBand() / 2) - r(d.target.id.length); 
						}
						else if ((x(d.target.sumbu_x) < x(d.source.sumbu_x)) && (y(d.target.sumbu_y) == y(d.source.sumbu_y))) {
							return x(d.target.sumbu_x) + (x.rangeBand() / 2) + r(d.target.id.length); 
						}
						else if(x(d.target.sumbu_x) == x(d.source.sumbu_x)) {
							return x(d.source.sumbu_x) + (x.rangeBand() / 2);
						} else {
							return hitungX2((x(d.source.sumbu_x) + (x.rangeBand() / 2)), (y(d.source.sumbu_y) + (y.rangeBand() / 2)),(x(d.target.sumbu_x) + (x.rangeBand() / 2)),(y(d.target.sumbu_y) + (y.rangeBand() / 2)), r(d.target.id.length));
						}   
					})
					.attr("y2", function(d) {
						if(y(d.target.sumbu_y) == y(d.source.sumbu_y)) {
							return y(d.target.sumbu_y) + (y.rangeBand() / 2);
						}
						else if((x(d.target.sumbu_x) == x(d.source.sumbu_x)) && (y(d.target.sumbu_y) > y(d.source.sumbu_y))) {
							return (y(d.target.sumbu_y) + (y.rangeBand() / 2) - r(d.target.id.length));
						}
						else if((x(d.target.sumbu_x) == x(d.source.sumbu_x)) && (y(d.target.sumbu_y) < y(d.source.sumbu_y))) {
							return (y(d.target.sumbu_y) + (y.rangeBand() / 2) + r(d.target.id.length));
						} else {
							var miring = Math.sqrt(Math.pow(((x(d.source.sumbu_x) + x.rangeBand() / 2) - (x(d.target.sumbu_x) + x.rangeBand() / 2)), 2) + Math.pow(((y(d.source.sumbu_y) + y.rangeBand() / 2) - (y(d.target.sumbu_y) + y.rangeBand() / 2)), 2));
							return y(d.source.sumbu_y) + (y.rangeBand() / 2)-(((miring - r(d.target.id.length)) * ((y(d.source.sumbu_y) + (y.rangeBand() / 2)) - (y(d.target.sumbu_y) + (y.rangeBand() / 2))) / miring));
						}
					})
					.attr("marker-end", function(d, i) { return "url(#" + i + ")"; });
				}
			}

			//////////////////////////
			// Membuat link selesai //
			//////////////////////////
 
			// // Panah dan garis hanya akan dibuat jika linknya ada
			// if(rlink.length != 0) {
			// 	// Untuk membuat panah
			// 	var marker = chart.select(".draggable").selectAll("g.marker").data(data.links)
			// 		.enter().append("svg:marker")
			// 		.attr("id", function(d, i) { return i; })
			// 		.attr("viewBox", "0 -5 10 10")
			// 		.attr("refX", function(d) {
			// 			if((y(d.target.value) == y(d.source.value)) && (x(d.target.sumbu_x) == x(d.source.sumbu_x))) {}
						 
			// 			if(x(d.target.sumbu_x) > x(d.source.sumbu_x)) {
			// 				return 10;
			// 			} else {
			// 				return 10;
			// 			}           
			// 		})
			// 		.attr("refY", 0)
			// 		.attr("markerWidth", 6)
			// 		.attr("markerHeight", 6)
			// 		.attr("orient", "auto")
			// 		.append("svg:path")
			// 		.attr("d", "M0,-5L10,0L0,5")
			// 		.attr("fill","none")
			// 		.attr("stroke","black");
				 
			// 	// (X1, Y1) koordinat asal
			// 	// (X2, Y2) koordinat tujuan
				 
			// 	// Hitung X : mencari x untuk x1 jika garisnya miring
			// 	// Hitung X2 : mencari x untuk x2 jika garisnya miring
			// 	var link = chart.select(".draggable").selectAll("g.link").data(rlink)
			// 	.enter().append("line")
			// 	.attr("class", "tes0")
			// 	.classed("link", true)
			// 	.attr("x1", function(d) {
			// 		if((y(d.target.sumbu_y) == y(d.source.sumbu_y)) && (x(d.target.sumbu_x) > x(d.source.sumbu_x))) {
			// 			return x(d.source.sumbu_x)+ (x.rangeBand() / 2) + r(d.source.id.length); 
			// 		}
					 
			// 		// Garis horizontal jika lingkaran asal ada di kiri target
			// 		else if ((y(d.target.sumbu_y) == y(d.source.sumbu_y)) && (x(d.target.sumbu_x) < x(d.source.sumbu_x))) {
			// 			return x(d.source.sumbu_x) + (x.rangeBand() / 2) - r(d.source.id.length);
			// 		}
					 
			// 		// Garis vertical
			// 		else if(x(d.target.sumbu_x) == x(d.source.sumbu_x)) {
			// 			return x(d.source.sumbu_x) + (x.rangeBand() / 2);
			// 		}
					 
			// 		// Garis miring
			// 		else {
			// 			return hitungX((x(d.source.sumbu_x) + (x.rangeBand() / 2)),(y(d.source.sumbu_y) + (y.rangeBand() / 2)), (x(d.target.sumbu_x) + (x.rangeBand() / 2)), (y(d.target.sumbu_y) + (y.rangeBand() / 2)), r(d.source.id.length));
			// 		}
			// 	})
			// 	.attr("y1", function(d) { 
			// 		//garis horizontal
			// 		if(y(d.target.sumbu_y) == y(d.source.sumbu_y)) {
			// 			return y(d.source.sumbu_y) + (y.rangeBand() / 2);
			// 		}
					 
			// 		//garis vertical dengan lingkaran asal ada di atas target
			// 		else if((x(d.target.sumbu_x) == x(d.source.sumbu_x)) && (y(d.target.sumbu_y) > y(d.source.sumbu_y))) {
			// 			return (y(d.source.sumbu_y)+ (y.rangeBand() / 2) + r(d.source.id.length));
			// 		}
					 
			// 		//garis vertical dengan lingkaran asal ada di bawah target
			// 		else if((x(d.target.sumbu_x) == x(d.source.sumbu_x)) && (y(d.target.sumbu_y) < y(d.source.sumbu_y))) {
			// 			return (y(d.source.sumbu_y) + (y.rangeBand() / 2) - r(d.source.id.length));
			// 		}
 
			// 		else {
			// 			var miring = Math.sqrt(Math.pow(((x(d.source.sumbu_x) + x.rangeBand() / 2)-(x(d.target.sumbu_x) + x.rangeBand() / 2)), 2) + Math.pow(((y(d.source.sumbu_y)+y.rangeBand() / 2)-(y(d.target.sumbu_y) + y.rangeBand() / 2)), 2));
			// 			return (y(d.source.sumbu_y) + y.rangeBand() / 2)-(((y(d.source.sumbu_y) + y.rangeBand() / 2)-(y(d.target.sumbu_y) + y.rangeBand() / 2)) * r(d.source.id.length) / miring);
			// 		}
			// 	})
			// 	// Sama seperti diatas, hanya untuk lingkaran target
			// 	.attr("x2", function(d) {
			// 		if((x(d.target.sumbu_x) > x(d.source.sumbu_x)) && (y(d.target.sumbu_y) == y(d.source.sumbu_y))) {
			// 			return x(d.target.sumbu_x) + (x.rangeBand() / 2) - r(d.target.id.length); 
			// 		}
			// 		else if ((x(d.target.sumbu_x) < x(d.source.sumbu_x)) && (y(d.target.sumbu_y) == y(d.source.sumbu_y))) {
			// 			return x(d.target.sumbu_x) + (x.rangeBand() / 2) + r(d.target.id.length); 
			// 		}
			// 		else if(x(d.target.sumbu_x) == x(d.source.sumbu_x)) {
			// 			return x(d.source.sumbu_x) + (x.rangeBand() / 2);
			// 		} else {
			// 			return hitungX2((x(d.source.sumbu_x) + (x.rangeBand() / 2)), (y(d.source.sumbu_y) + (y.rangeBand() / 2)),(x(d.target.sumbu_x) + (x.rangeBand() / 2)),(y(d.target.sumbu_y) + (y.rangeBand() / 2)), r(d.target.id.length));
			// 		}   
			// 	})
			// 	.attr("y2", function(d) {
			// 		if(y(d.target.sumbu_y) == y(d.source.sumbu_y)) {
			// 			return y(d.target.sumbu_y) + (y.rangeBand() / 2);
			// 		}
			// 		else if((x(d.target.sumbu_x) == x(d.source.sumbu_x)) && (y(d.target.sumbu_y) > y(d.source.sumbu_y))) {
			// 			return (y(d.target.sumbu_y) + (y.rangeBand() / 2) - r(d.target.id.length));
			// 		}
			// 		else if((x(d.target.sumbu_x) == x(d.source.sumbu_x)) && (y(d.target.sumbu_y) < y(d.source.sumbu_y))) {
			// 			return (y(d.target.sumbu_y) + (y.rangeBand() / 2) + r(d.target.id.length));
			// 		} else {
			// 			var miring = Math.sqrt(Math.pow(((x(d.source.sumbu_x) + x.rangeBand() / 2) - (x(d.target.sumbu_x) + x.rangeBand() / 2)), 2) + Math.pow(((y(d.source.sumbu_y) + y.rangeBand() / 2) - (y(d.target.sumbu_y) + y.rangeBand() / 2)), 2));
			// 			return y(d.source.sumbu_y) + (y.rangeBand() / 2)-(((miring - r(d.target.id.length)) * ((y(d.source.sumbu_y) + (y.rangeBand() / 2)) - (y(d.target.sumbu_y) + (y.rangeBand() / 2))) / miring));
			// 		}
			// 	})
			// 	.attr("marker-end", function(d, i) { return "url(#" + i + ")"; });
			// }
			// console.log(d3.transform(entering2.attr("transform")).translate[0]);

			if ($("#mode_pan option:selected").text() == 'Linier'){
				chart.call(grabAndDrag); // memanggil fungsi grabAndDrag jika mode pan=Linier
			}
			else {
				chart.call(distortion); // memanggil fungsi distortion jika mode pan=Distorsi
			}

			/* PANNING WITH DIRECT REPOSITIONING TECHNIQUE (GRAB AND DRAG) */
			function grabAndDrag(selection){
				selection.select('.background').on('mousemove',null);
				d3.select('#reset').style('visibility','visible');
				d3.select(".helpPan").style("visibility","visible");
				d3.select(".textInfo").style("visibility","hidden");
				selection.select('.background').style('cursor','-webkit-grab');
				
				selection.append('rect')
					.attr('class', 'block')
					.attr('fill', 'white')
					.attr('height', 200)
					.attr('width', 201)
					.attr("transform", "translate(-200,460)");
				selection.append('line')
					.style('stroke','#000')
					.style('shape-rendering','crispEdges')
					.attr('x1',0).attr('y1',0)
					.attr('x2',0).attr('y2',460);
				selection.append('line')
					.style('stroke','#000')
					.style('shape-rendering','crispEdges')
					.attr('x1',0).attr('y1',460)
					.attr('x2',800).attr('y2',460);
				
				var drag = d3.behavior.drag()
					.on("drag", dragmove);

				function dragmove(d) {
					var translate = d3.transform(d3.select(".draggable").attr("transform")).translate;

							delta_x = d3.event.dx + translate[0],
							delta_y = d3.event.dy + translate[1];

					  d3.select(".draggable").attr('transform', 'translate(' + (delta_x) + ',' + (delta_y) + ')');
					  d3.select(".x").attr('transform', 'translate(' + (delta_x) + ',' + height + ')');	
					  d3.select(".y").attr('transform', 'translate(' + 0 + ',' + (delta_y) + ')');
					  // var transformTarget = getXYTranslate(panCanvas.attr("transform"));
					  d3.select(".frame").attr("transform", "translate(" + (-delta_x) + "," + (-delta_y) + ")");
				}
				selection.select('.background').call(drag);

				canvas.call(overviewmap); //call overview map

				d3.select("#reset").on('click', function(){
					selection.select('.draggable').transition()
						.attr("transform", function(d,i){
							return "translate(" + 0 + ", "+ 0 +")";
						})
					d3.select(".x.axis").transition().attr('transform', 'translate(' + 0 + ',' + height + ')');	
					d3.select(".y.axis").transition().attr('transform', 'translate(' + 0 + ',' + 0 + ')');
					d3.select(".frame").transition().attr("transform", "translate(" + 0 + "," + 0 + ")");
					canvas.select(".panCanvas").transition().attr("transform", "translate(" + 0 + "," + 0 + ")");
				})
			}

			/* PANNING WITH DISTORTION */
			function distortion(selection){
				
				selection.select('.background').on('mousedown.drag',null);
				canvas.select('.overviewmap').remove();
				d3.select('#reset').style('visibility','hidden');
				d3.select(".helpPan").style("visibility","hidden");
				d3.select(".textInfo").style("visibility","visible");
				selection.select('.background').style('cursor','default');
				//posisi awal peta 
				d3.select('.draggable').transition()
					.attr("transform", function(d,i){
					return "translate(" + 0 + ", " + 0 + ")";
				})
				d3.select(".x").transition().attr('transform', 'translate(' + 0 + ',' + height + ')');	
				d3.select(".y").transition().attr('transform', 'translate(' + 0 + ',' + 0 + ')');
				panCanvas.transition().attr('transform','translate(0,0)');
				//respond to the mouse and distort where necessary
				selection.select(".background").on("mousemove", function(){
				if(d3.event.ctrlKey){	//if the ctrl key is not pressed
					var mouse = d3.mouse(this);
					x.distortion(2).focus(mouse[0]);
					y.distortion(2).focus(mouse[1]);

					//redraw node 	
					entering2.attr("transform", function(d, i) {
						return "translate(" +
									(x(d.sumbu_x)+ (x.rangeBand()/2))
									
							 + ", "+
									(y(d.sumbu_y)+ (y.rangeBand()/2))
									
							 +")";
					 });

					entering2.select("circle").attr("r",function(d){
						var rmax = 30;
						var xFeye, yFeye, a, b;
						xFeye = (x(d.sumbu_x) + (x.rangeBand() / 2));
						yFeye = (y(d.sumbu_y) + (y.rangeBand() / 2));
						a = Math.abs(rmax-(Math.abs(mouse[0]-xFeye)/rmax));
						b = Math.abs(rmax-(Math.abs(mouse[1]-yFeye)/rmax));
						if (a<b) {return a; }
						else { return b; }
					});

					entering2.select("text")
						.attr("dy", function(d){return d.id.length+3 + "px";})
			   		    .text(function(d) {return d.id.length;})
					    .attr("font-size",function(d){
						//jari-jari pada fisheye view
						var rmax = 30, fontmax = 14;
						var xFeye, yFeye, a, b, r;
						xFeye = (x(d.sumbu_x) + (x.rangeBand() / 2));
						yFeye = (y(d.sumbu_y) + (y.rangeBand() / 2));
						a = Math.abs(rmax-(Math.abs(mouse[0]-xFeye)/rmax));
						b = Math.abs(rmax-(Math.abs(mouse[1]-yFeye)/rmax));
						if (a<b) { r=a; }
						else { r=b; }
						//ukuran font text relatif terhadap jari-jari lingkaran
						return Math.abs(fontmax-(r+8));
					});
					
					//redraw link
					link.attr("x1", function(d) {
								//garis horizontal jika lingkaran asal ada di kanan target
								if((y(d.target.sumbu_y)==y(d.source.sumbu_y)) && (x(d.target.sumbu_x) > x(d.source.sumbu_x)))
								{
									return x(d.source.sumbu_x)+ (x.rangeBand()/2)+r(d.source.id.length); 
								}
								//garis horizontal jika lingkaran asal ada di kiri target
								else if ((y(d.target.sumbu_y)==y(d.source.sumbu_y)) && (x(d.target.sumbu_x) < x(d.source.sumbu_x)))
								{
									return x(d.source.sumbu_x)+ (x.rangeBand()/2)-r(d.source.id.length);
								}
								//garis vertical
								else if(x(d.target.sumbu_x) == x(d.source.sumbu_x))
								{
									return x(d.source.sumbu_x)+(x.rangeBand()/2);
								}
								//garis miring
								else
								{
									return hitungX((x(d.source.sumbu_x)+ (x.rangeBand()/2)),(y(d.source.sumbu_y)+ (y.rangeBand()/2)),(x(d.target.sumbu_x)+ (x.rangeBand()/2)),(y(d.target.sumbu_y)+ (y.rangeBand()/2)),r(d.source.id.length));
								}	 	  
						  })
						  .attr("y1", function(d) { 
								//garis horizontal
								if(y(d.target.sumbu_y)==y(d.source.sumbu_y))
								{
									return y(d.source.sumbu_y)+ (y.rangeBand()/2); 
								}
								//garis vertical dengan lingkaran asal ada di atas target
								else if((x(d.target.sumbu_x)==x(d.source.sumbu_x)) && (y(d.target.sumbu_y) > y(d.source.sumbu_y)))
								{
									return (y(d.source.sumbu_y)+ (y.rangeBand()/2) + r(d.source.id.length));
								}
								//garis vertical dengan lingkaran asal ada di bawah target
								else if((x(d.target.sumbu_x)==x(d.source.sumbu_x)) && (y(d.target.sumbu_y) < y(d.source.sumbu_y)))
								{
								return (y(d.source.sumbu_y)+ (y.rangeBand()/2) - r(d.source.id.length));
								}
								else
								//garis miring
								{
									var miring=Math.sqrt(Math.pow(((x(d.source.sumbu_x)+x.rangeBand()/2)-(x(d.target.sumbu_x)+x.rangeBand()/2)),2)+Math.pow(((y(d.source.sumbu_y)+y.rangeBand()/2)-(y(d.target.sumbu_y)+y.rangeBand()/2)),2));						
									return (y(d.source.sumbu_y)+y.rangeBand()/2)-(((y(d.source.sumbu_y)+y.rangeBand()/2)-(y(d.target.sumbu_y)+y.rangeBand()/2))*r(d.source.id.length)/miring);
								}
						  })
						  //sama seperti diatas, hanya untuk lingkaran target
						  .attr("x2", function(d) { 
								if((x(d.target.sumbu_x) > x(d.source.sumbu_x)) && (y(d.target.sumbu_y)==y(d.source.sumbu_y)))
								{
									return x(d.target.sumbu_x)+ (x.rangeBand()/2)-r(d.target.id.length); 
								}
								else if ((x(d.target.sumbu_x) < x(d.source.sumbu_x)) && (y(d.target.sumbu_y)==y(d.source.sumbu_y)))
								{
									return x(d.target.sumbu_x)+ (x.rangeBand()/2)+r(d.target.id.length); 
								}
								else if(x(d.target.sumbu_x) == x(d.source.sumbu_x))
								{
									return x(d.source.sumbu_x)+(x.rangeBand()/2);
								}
								else
								{
									return hitungX2((x(d.source.sumbu_x) + (x.rangeBand()/2)),(y(d.source.sumbu_y) + (y.rangeBand()/2)),(x(d.target.sumbu_x) + (x.rangeBand()/2)),(y(d.target.sumbu_y) + (y.rangeBand()/2)),r(d.target.id.length));
									
								}	
						  })
						  .attr("y2", function(d) {
								if(y(d.target.sumbu_y)==y(d.source.sumbu_y))
								{
								return y(d.target.sumbu_y)+ (y.rangeBand()/2); 
								}
								else if((x(d.target.sumbu_x)==x(d.source.sumbu_x)) && (y(d.target.sumbu_y) > y(d.source.sumbu_y)))
								{
								return (y(d.target.sumbu_y)+ (y.rangeBand()/2) - r(d.target.id.length));
								}
								else if((x(d.target.sumbu_x)==x(d.source.sumbu_x)) && (y(d.target.sumbu_y) < y(d.source.sumbu_y)))
								{
								return (y(d.target.sumbu_y)+ (y.rangeBand()/2) + r(d.target.id.length));
								}
								else
								{
									var miring=Math.sqrt(Math.pow(((x(d.source.sumbu_x)+x.rangeBand()/2)-(x(d.target.sumbu_x)+x.rangeBand()/2)),2)+Math.pow(((y(d.source.sumbu_y)+y.rangeBand()/2)-(y(d.target.sumbu_y)+y.rangeBand()/2)),2));
									return y(d.source.sumbu_y)+ (y.rangeBand()/2)-(((miring-r(d.target.id.length))*((y(d.source.sumbu_y)+ (y.rangeBand()/2))-(y(d.target.sumbu_y)+ (y.rangeBand()/2)))/miring));
								}
						  
						  })
						  .attr("marker-end", function(d,i) { return "url(#"+i+")"; });

				  selection.select(".x.axis").call(xAxis);
				  selection.select(".y.axis").call(yAxis);
				}
				});
			}

			/* PANNING WITH NAVIGATION WINDOW TECHNIQUE (OVERVIEW MAP) */	
			function overviewmap(selection){
				var target = panCanvas,
					overviewScale = 0.095,
					scale = 1,
					frameX,
					frameY;
				var base = selection;
				var container = selection.append("g")
					.attr("class", "overviewmap");
				   
				overviewmap.node = container.node();

				var frame = container.append("g")
					.attr("class", "frame")
					.attr('transform','translate(0,0)');

				frame.append("rect")
					.attr("class", "background")
					.attr("width", width)
					.attr("height", height)
					.attr("filter", "url(#overviewDropShadow)");
					
				var drag = d3.behavior.drag()
					.on("dragstart.overviewmap", function() {
						var frameTranslate = getXYTranslate(frame.attr("transform"));
							frameX = frameTranslate[0];
							frameY = frameTranslate[1];
					})
					.on("drag.overviewmap", function() {
						d3.event.sourceEvent.stopImmediatePropagation();
							frameX += d3.event.dx;
							frameY += d3.event.dy;
							frame.attr("transform", "translate(" + frameX + "," + frameY + ")");
							var translate =  [(-frameX*scale),(-frameY*scale)];
							target.attr("transform", "translate(" + translate + ")scale(" + scale + ")");
							d3.select('.x').attr('transform', 'translate(' + (-frameX*scale) + ',' + height + ')scale('+ scale +')');	
							d3.select('.y').attr('transform', 'translate(' + 0 + ',' + (-frameY*scale) + ')scale('+ scale +')');
					});

				frame.call(drag);
				var render = function(){
					// scale = 1.75;
					container.attr("transform", "scale(" + overviewScale + ")translate(0,100)");
					var node = target.node().cloneNode(true);
					node.removeAttribute("id");
					base.selectAll(".overviewmap .panCanvas").remove();
					overviewmap.node.appendChild(node);
					var transformTarget = getXYTranslate(target.attr("transform"));
					frame.attr("transform", "translate(" + (-transformTarget[0]/scale) + "," + (-transformTarget[1]/scale) + ")")
						.select(".background")
						.attr("width", width/scale)
						.attr("height", height/scale);
					frame.node().parentNode.appendChild(frame.node());
					d3.select(node).attr("transform", "translate(0,0)");
				};
				selection.call(render);
			}

			function getXYTranslate(translateString){
				var split = translateString.split(",");
				var x = split[0] ? ~~split[0].split("(")[1] : 0;
				var y = split[1] ? ~~split[1].split(")")[0] : 0;
				return [x, y];
			}
		}
 
		var view;
		var active = d3.select(null);
		var counter = 0;
			 
		function transition(d, chart, x, y) {
			var dx = 40.5 * 2, dy = 40.5 * 2;
			scale = .9 / Math.max(dx / width, dy / height),
			translate = [width / 2 - scale * x, height / 2 - scale * y + 50];
			 
			chart.transition()
			.duration(750)
			.style("stroke-width", 1.5 / scale + "px")
			.attr("transform", "translate(" + translate + ")scale(" + scale + ")")
			.each("end", function() {
				counter += 1;
				d3.select(".chart")
				.style("display", "none");
				d3.select("#sequence")
				.style("display", "inline");
				d3.select("#home")
				.style("display", "inline");
				d3.select(".svg")
				.style("display", "inline");
				d3.select(".circle_packing")
				.style("display", "inline");
				d3.select("#circle_packing")
				.style("display", "inline");
				if(counter == 1){
					return intialZoomed(d, chart, x, y);
				} else {
						//return intialZoomed(d, chart, x, y);
					}
			});
		}
			 
		function returnTransition() {
			var dx = 40.5 * 2, dy = 40.5 * 2;
			scale = .9 / Math.max(dx / width, dy / height),
			//scale = 5,
			translate = [150, 10];
			 
			chart.transition()
			.duration(750)
			.style("stroke-width", 1 + "px")
			.attr("transform", "translate(150,10)");
		}
 
		var circle2;
		var text2;
		var node2;
		var diameter = 110;
		var nodes2;
			 
		function intialZoomed(data2, chart, x, y) {
			initializeBreadcrumbTrail();
			var color = d3.scale.linear()
			.domain([-1, 5])
			.range(["hsl(152,80%,80%)", "hsl(228,30%,40%)"])
			.interpolate(d3.interpolateHcl);
 
			var deepest;
			 
			var opacity = d3.scale.linear()
			.domain([0, 3])
			.range([0, 1]);
			 
			var focus = data2,view;
			nodes2 = pack.nodes(data2);
			mouseoverInit();
			 
			var svg = d3.select(".svg")
			.attr("width", 950)
			.attr("height", 515)
			.append("g")
			.attr("class","graph")
			.attr("transform", "translate(" + 950 / 2 + "," + height / 2 + ")");
 
			// var  svg = d3.select("body").append("svg")
			// .attr("width", 950)
			// .attr("height", 515)
			// .append("g")
			// .attr("transform", "translate(" + 950 / 2 + "," + height / 2 + ")");
 
			var circle_packing = d3.select(".circle_packing")
			.attr("width", 443)
			.attr("height", 443)
			.append("g")
			.attr("class","g_circle")
			.attr("transform", "translate(" + 220 + "," + 220 + ")");

			d3.select('#reset').style('visibility','hidden');
			d3.select('.helpPan').style('visibility','hidden');
			d3.select('.textInfo').style('visibility','hidden');
 
			circle2 = circle_packing.selectAll("circle").data(nodes2)
			.enter().append("circle")
			.attr("class", function(d) { return d.parent ? d.children ? "node" : "node node--leaf" : "node node--root"; })
			.style("fill", function(d) { if(d.children && d.parent) { return "#224389"; } else if(!d.parent) { return null; } else {return "#3B5998"; }})
			.style("stroke", function(d) { if(!d.parent) { return "white"; }})
			.style("display", function(d) { if (d.parent === focus) { return "inline"; } else { return d.parent === data2 ? null : "none"; }})
			// .style("fill-opacity", function(d){if(!d.parent){return "white";} else if(d.children){ return opacity(d.depth);}})
			// .style("display", function(d) { return d.parent== null || d.parent === data2 ? null : "none"; })
			.on("click", function(d) {
				if (d.children) {
					mouseover(d);
					zoom(d), d3.event.stopPropagation();
				} else {
					if(document.URL.indexOf("#") >= 0) {
						var location = document.URL.split("#");
						document.location.href = location[0] + '#ShowDetailPaper';
					} else {
						document.location.href = document.URL + '#ShowDetailPaper';
					}
 
					var maxKey, maxValue;
					maxKey = 0;
					maxValue = 0;
					$.each(d, function(key, value) {
						if(maxKey < key.length) {
							maxKey = key.length;
						}
						if(maxValue < value.length) {
							maxValue = value.length;
						}
					});
 
					$.each(d, function(key, value) {
						if(key == "id" || key == "name" || key == "depth" || key == "value" || key == "parent" || key == "r" || key == "x" || key == "y" || key == "creater") {}
						else {
							$( "#popup-content" ).append( "<li><label style=\"width:" + maxKey * 8 + "px\">" + key + "</label><label style=\"width:10px\"> : </label></li>" );
							if(value == "") {}
							else {
								$( "#popup-content" ).append('<span class="detail-content">'+value+'</span>');
							}
						}
					}); 
					$('a[href="#close"]').click(function(){
						$( "#popup-content" ).empty();
						$( "#map_name" ).val('');
					});
					$('a[href="#x"]').click(function(){
						$( "#popup-content" ).empty();
						$( "#map_name" ).val('');
					});
				}
			})
			 
			text2 = circle_packing.selectAll("text")
			.data(nodes2)
			.enter().append("text")
			.attr("class", "label2")
			.style("fill","white")
			.style("fill-opacity", function(d) { return d.parent === data2 ? 1 : 0; })
			// .style("display", function(d) {if (d.parent === focus) { return "inline" } else {return d.parent === data2 ? null : "none"; }})
			.style("word-wrap", "break-word")
			.style("width", "10em")
			.text(function(d) {
				var text = String(d.name).split(" ");
				var retText;
				for(var i = 0; i < text.length; i++) {
					if (text[i] != "") {
						retText += text[i];
						retText += "\n";
					}
				}
				
				console.log(retText);
				
				// return retText;
				return d.name;
			});
			
			// text2 = circle_packing.selectAll("text")
			// .data(nodes2)
			// .enter().append("foreignObject")
			// .attr("x", function(d) {
				// console.log("circle2");
				// console.log(d3.transform(circle2.attr("transform")).translate[0]);
				
				// console.log("circle_packing");
				// console.log(d3.transform(circle_packing.attr("transform")).translate[0]);
				
				// var finalx = d3.transform(circle2.attr("transform")).translate[0] + d3.transform(circle_packing.attr("transform")).translate[0];
				// return finalx;
			// })
			// .attr("y", function(d) {
				// console.log("circle2");
				// console.log(d3.transform(circle2.attr("transform")).translate[0]);
				
				// console.log("circle_packing");
				// console.log(d3.transform(circle_packing.attr("transform")).translate[0]);

				// var finaly = d3.transform(circle2.attr("transform")).translate[1] + d3.transform(circle_packing.attr("transform")).translate[1];
				// return finaly;
			// })
			// .attr("width", "100")
			// .attr("height", "100")
			// .style("word-wrap", "break-word")
			// .style("width", "10em")
			// .append("xhtml")
			// .attr("class", "label2")
			// // .style("fill-opacity", function(d) { return d.parent === data2 ? 1 : 0; })
			// // .style("display", function(d) {if (d.parent === focus) { return "inline" } else {return d.parent === data2 ? null : "none"; }})
			// .text(function(d) {
				// // var text = String(d.name).split(" ");
				// // var retText;
				// // for(var i = 0; i < text.length; i++) {
					// // if (text[i] != "") {
						// // retText += text[i];
						// // retText += "\n";
					// // }
				// // }
				
				// // console.log(retText);
				
				// // return retText;
				// return d.name;
			// })
			// .attr('style', 'text-align:center; padding:10px; margin:10px;');
			
			node2 = circle_packing.selectAll("circle,text");
			zoomTo([data2.x, data2.y, 52.28]);
			 
			var arrayX = [];
			arrayX[0]=  { sumbu_x:data2.sumbu_x };
			var arrayY = [];
			arrayY[0]= { sumbu_y:data2.sumbu_y };
 
			var x2 = d3.scale.ordinal()
			.rangeRoundBands([0, 600], .1)
			.domain(arrayX.map(function(d) {return d.sumbu_x; }));
			var y2 = d3.scale.ordinal()
			.rangeRoundBands([height, 0], .1)
			.domain(arrayY.map(function(d) {return d.sumbu_y; }));
			 
			var xAxis2 = d3.svg.axis()
			.scale(x2)
			.orient("bottom");
 
			var yAxis2 = d3.svg.axis()
			.scale(y2)
			.orient("left");
 
			svg.append("g")
			.attr("class", "x axis")
			.attr("transform", "translate(-300," + 230 + ")")
			.call(xAxis2);
 
			svg.append("g")
			.attr("class", "y axis")
			.attr("transform", "translate(-300,-230)")
			.call(yAxis2);
 
			if($("#sumbuY option:selected").text().indexOf(' ') >= 0) {
				svg.append("text")
				.attr("class", "sumbuYlabel")
				.attr("text-anchor", "middle")  // this makes it easy to centre the text as the transform is applied to the anchor
				.attr("transform", "translate(" + -400 + "," + (-5) + ")")  // text is drawn off the screen top left, move down and out and rotate
				.text($("#sumbuY option:selected").text().split(' ')[0]);
 
				svg.append("text")
				.attr("class", "sumbuYlabel")
				.attr("text-anchor", "middle")  // this makes it easy to centre the text as the transform is applied to the anchor
				.attr("transform", "translate(" + -400 + "," + (10) + ")")  // text is drawn off the screen top left, move down and out and rotate
				.text($("#sumbuY option:selected").text().split(' ')[1]);
 
				svg.append("text")
				.attr("class", "sumbuXlabel")
				.attr("text-anchor", "middle")  // this makes it easy to centre the text as the transform is applied to the anchor
				.attr("transform", "translate(" + (0) + "," + (270) + ")")  // centre below axis
				.text($("#sumbuX option:selected").text());
			} else {
				svg.append("text")
				.attr("class", "sumbuYlabel")
				.attr("text-anchor", "middle")  // this makes it easy to centre the text as the transform is applied to the anchor
				.attr("transform", "translate(" + -400 + "," + (0) + ")")  // text is drawn off the screen top left, move down and out and rotate
				.text($("#sumbuY option:selected").text());
 
				svg.append("text")
				.attr("class", "sumbuXlabel")
				.attr("text-anchor", "middle")  // this makes it easy to centre the text as the transform is applied to the anchor
				.attr("transform", "translate(" + (0) + "," + (270) + ")")  // centre below axis
				.text($("#sumbuX option:selected").text());
			}
		}
 
		function zoom(data) {
			var focus0 = focus; focus = data;
			var transition = d3.transition()
			.duration(d3.event.altKey ? 7500 : 750)
			.tween("zoom", function(d) {
				if(data.parent) {
					var i = d3.interpolateZoom(view, [focus.x, focus.y, focus.r / 2]);
				} else {
					var i = d3.interpolateZoom(view, [focus.x, focus.y, diameter / 2]);
				}
 
				return function(t) { zoomTo(i(t)); };
			});
 
			transition.selectAll("text")
			.filter(function(d) { if (typeof d !== "undefined"){ return d.parent === focus || this.style.display === "inline"; }})
			.style("fill-opacity", function(d) { return d.parent === focus ? 1 : 0; })
			.each("start", function(d) { if (d.parent === focus) this.style.display = "inline"; })
			.each("end", function(d) { if (d.parent !== focus) this.style.display = "none"; });
 
			transition.selectAll("circle")
			.filter(function(d) { if (typeof d !== "undefined"){ return d.parent === focus || this.style.display === "inline"; }})
			.style("fill-opacity", function(d) { return d.parent === focus ? 1 : 0; })
			.each("start", function(d) { if (d.parent === focus) this.style.display = "inline"; })
			.each("end", function(d) { if (d.parent !== focus) this.style.display = "none"; });
		}
 
		function zoomTo(v) {
			var k = diameter / v[2];
			view = v;
			node2.attr("transform", function(d) { return "translate(" + (d.x - v[0]) * k + "," + (d.y - v[1]) * k + ")"; });
			circle2.attr("r", function(d) { return d.r * k; });
		}
 
		$("#home").click(function(){
			if ($("#mode_pan option:selected").text() == 'Linier'){
				d3.select("#reset").style("visibility","visible");
				d3.select('.helpPan').style('visibility','visible');
			}
			else{ 
				d3.select("#reset").style("visibility","hidden"); 
				d3.select('.textInfo').style('visibility','visible');
			}
			counter = 0;
			d3.select(".graph").remove();
			d3.select("#trail").remove();
			d3.select(".g_circle").remove();
			d3.select(".svg")
			.style("display", "none");
			d3.select("#sequence")
			.style("display", "none");
			d3.select("#home")
			.style("display", "none");
			d3.select(".circle_packing")
			.style("display", "none");
			d3.select(".chart")
			.style("display", "inline");
			returnTransition();
		});
 
		function getXmlHttpRequest() {
			var xmlHttpObj;
 
			if(window.XMLHttpRequest)
				xmlHttpObj = new XMLHttpRequest();
			else {
				try {
					xmlHttpObj = new ActiveXObject("Msxm12.XMLHTTP");
				}
				catch(e) {
					try {
						xmlHttpObj = new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch(e) {
						xmlHttpObj = false;
					}
				}
			}
			return xmlHttpObj;
		}
 
		// Fungsi untuk mendapatkan data sesuai dengan parameter pada sumbu x, sumbu y, dan jenis relasi
		function getData(sbX, sbY, parameter, edge, zooming, pan){
			window.xmlhttp = getXmlHttpRequest();
			if(!window.xmlhttp)
				return;
			window.xmlhttp.open('POST', 'index.php?r=metadataPenelitian/getData ', true);
			var query = 'sumbuX=' + sbX + '&sumbuY=' + sbY + '&parameter=' + parameter + '&edge=' + edge + '&zooming=' + zooming + '&mode_pan=' + pan;
 
			window.xmlhttp.onreadystatechange = function() {
				if(window.xmlhttp.readyState == 4 && window.xmlhttp.status == 200) {
					var response = window.xmlhttp.responseText;
					counter = 0;
					d3.select(".graph").remove();
					d3.select("#trail").remove();
					d3.select(".g_circle").remove();
 
					redraw(response);
					//drawTablePaper(response);
				}
			};
			window.xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			window.xmlhttp.send(query);     
		}
		 
		// Fungsi untuk mendapatkan data sesuai dengan parameter pada sumbu x, sumbu y, dan jenis relasi pada inisialisasi
		function getDataInit(sbX, sbY, parameter, edge, zooming, pan){
			window.xmlhttp = getXmlHttpRequest();
			if(!window.xmlhttp)
				return;
			window.xmlhttp.open('POST', 'index.php?r=metadataPenelitian/getData ', true);
			var query = 'sumbuX=' + sbX + '&sumbuY=' + sbY + '&parameter=' + parameter + '&edge=' + edge + '&zooming=' + zooming + '&mode_pan=' + pan;
			
			window.xmlhttp.onreadystatechange = function() {
				if(window.xmlhttp.readyState == 4 && window.xmlhttp.status == 200) {
					var response = window.xmlhttp.responseText;
					//console.log(response);
					//data = JSON.parse(response);
					//console.log(data);
					 
					redraw(response);
					initTable(response);
					drawTablePaper(response);
					data = JSON.parse(response);
						 
					for(var i = 0; i < data.relation.length; i++) {
						dataString = dataString.concat("<li><b>" + data.relation[i].deskripsi + "</b> : " + data.relation[i].keterangan + "</li>");
					}
					if(userID == "" || help != "") {
						startIntro(dataString);
							<?php unset(Yii::app()->session['help']);?>
					}
				}
			};
			window.xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			window.xmlhttp.send(query);
		}
		 
		// Fungsi untuk mengubah tampilan apabila dilakukan perubahan pada sumbu x
		$("#sumbuX").change(function() {
			$('.sumbuXlabel').remove();
			$('.sumbuYlabel').remove();
			sumbuX = $("#sumbuX option:selected").text();
			sumbuY = $("#sumbuY option:selected").text();
			defaultX = sumbuX;      
			edge = $("#edge option:selected").text();
			zooming = $("#mode_zoom option:selected").text();
			pan = $("#mode_pan option:selected").text();
			if(typeof(sumbuX) != 'undefined' && typeof(sumbuY) != 'undefined') {
				if(typeof(parameter) == 'undefined') {
					getData(sumbuX, sumbuY, 'all', edge, zooming, pan);
				}
				else {
					getData(sumbuX, sumbuY, parameter, edge, zooming, pan);
				}
			}
		});
		 
		// Fungsi untuk mengubah tampilan apabila dilakukan perubahan pada sumbu y
		$( "#sumbuY" ).change(function() {
			$('.sumbuXlabel').remove();
			$('.sumbuYlabel').remove();
			sumbuX = $("#sumbuX option:selected").text();
			sumbuY = $("#sumbuY option:selected").text();
			defaultY = sumbuY;
			edge = $("#edge option:selected").text();
			zooming = $("#mode_zoom option:selected").text();
			pan = $("#mode_pan option:selected").text();
			if(typeof(sumbuX) != 'undefined' && typeof(sumbuY) != 'undefined') {
				if(typeof(parameter) == 'undefined') {
					getData(sumbuX, sumbuY, 'all', edge, zooming, pan);
				} else {
					getData(sumbuX, sumbuY, parameter, edge, zooming, pan);
				}
			}
		});
		 
		// Fungsi untuk mengubah tampilan apabila dilakukan perubahan pada jenis relasi
		$("#edge").change(function() {
			sumbuX = $("#sumbuX option:selected").text();
			sumbuY = $("#sumbuY option:selected").text();
			edge = $("#edge option:selected").text();
			defaultEdge = edge;
			zooming = $("#mode_zoom option:selected").text();
			pan = $("#mode_pan option:selected").text();
			if(typeof(edge) != 'undefined') {
				if(typeof(parameter) == 'undefined') {
					getData(sumbuX, sumbuY, 'all', edge, zooming, pan);
				}
				else {
					getData(sumbuX, sumbuY, parameter, edge, zooming, pan);
				}
			}
		});

		$("#mode_zoom").change(function() {
			sumbuX = $("#sumbuX option:selected").text();
			sumbuY = $("#sumbuY option:selected").text();
			edge = $("#edge option:selected").text();
			zooming = $("#mode_zoom option:selected").text();
			pan = $("#mode_pan option:selected").text();

			if(zooming == "Fisheye + Semantic") {
				window.location.assign("http://localhost/citationnetwork/ta_updated/index.php?r=site/indexFisheye")
			} else if(zooming == "Breadcrumbs") {
				window.location.assign("http://localhost/citationnetwork/ta_updated/index.php?r=site/index")
			}
		});
		
		$("#mode_pan").change(function() {
			sumbuX = $("#sumbuX option:selected").text();
			sumbuY = $("#sumbuY option:selected").text();
			edge = $("#edge option:selected").text();
			zooming = $("#mode_zoom option:selected").text();
			pan = $("#mode_pan option:selected").text();
			defaultPan=pan;
			if(typeof(pan) != 'undefined')
			{
				if(typeof(parameter)=='undefined')
				{
					getData(sumbuX, sumbuY,'all',edge, zooming, pan);
				}
				else
				{
					getData(sumbuX, sumbuY,parameter,edge, zooming, pan);
				}
			
			}
		});

		function DropDown(el) {
			this.dd = el;
			this.placeholder = this.dd.children('span');
			this.opts = this.dd.find('ul.dropdown > li');
			this.val = '';
			this.index = -1;
			this.initEvents();
		}
		 
		DropDown.prototype = {
			initEvents : function() {
				var obj = this;
 
				obj.dd.on('click', function(event) {
					$(this).toggleClass('active');
					return false;
				});
 
				obj.opts.on('click',function() {
					var opt = $(this);
					obj.val = opt.text();
					obj.index = opt.index();
					obj.placeholder.text(obj.val);
				});
			},
			 
			getValue : function() {
				return this.val;
			},
			 
			getIndex : function() {
				return this.index;
			}
		}
 
		$(function() {
			var dd = new DropDown( $('#dd') );
 
			$(document).click(function() {
				// all dropdowns
				$('.wrapper-dropdown-3').removeClass('active');
			});
		});
 
		var table;
		var t;
 
		function initTable(data) {
			var data_selected = JSON.parse(data).all_data[0];
			var data_not_selected = JSON.parse(data).all_data[1];
			// Create new table unselected paper (id:TableAddPaper)
			table = $('#TableAddPaper').dataTable({
				"aaData": data_not_selected,
				"columns": [
					{ "data": "judul" },
					{ "data": "peneliti" }
				],
				"sScrollX" : "100%",
				"scrollY" : "200px",
				"scrollX": true,
				"scrollCollapse": true,
				"paging": false,
				"aaSorting": [],
 
				"fnCreatedRow": function( nRow, aData, iDataIndex ) {
					$(nRow).attr('id', aData['id']);
				}
			});
 
			// Create new table selected paper (id:AddedPaper)
			t = $('#AddedPaper').dataTable({
				"aaData": data_selected,
				"columns": [
					{ "data": "judul" },
					{ "data": "peneliti" }
				],
				"sScrollX": "100%",
				"scrollY" : "200px",
				"scrollX": true,
				"scrollCollapse": true,
				"paging": false,
				"aaSorting": [],
				"fnCreatedRow": function( nRow, aData, iDataIndex ) {
					$(nRow).attr('id', aData['id']);
				}
			});

			var jumlahPaper;
			 
			jumlahPaper = t.fnSettings().fnRecordsTotal();
			$("#jumlahPaper").text(jumlahPaper);
			if (jumlahPaper > 21) {
				//$('#SaveButton').attr('disabled','disabled');
			}
		}
 
		function drawTablePaper(data) {
			// Array of added paper
			var rowNode1 = new Array(100);
			var rowNode2 = new Array(100);
			 
			// Array 2 dimension of selected paper from unselected paper
			var dataPindah1 = new Array(100);
			var dataPindah2 = new Array(100);
			for (var i = 0; i < 100; i++) {
				dataPindah1[i] = new Array(3);
				dataPindah2[i] = new Array(3);
			}
 
			var time;
			// Counter : hitung 
			var counter, counter1, counter2, counter3;
			counter = 0; counter1 = 0; counter2 = 0; counter3 = 0;  
 
			// Set id pada data table scroll body selected paper (supaya waktu add paper ada efek scroll)
			$('.dataTables_scrollBody').eq(0).attr('id', 'TableAddPaperScrollBody');
			$('.dataTables_scrollBody').eq(1).attr('id', 'AddedPaperScrollBody');
 
			$('.dataTables_filter').find('input').attr("class", "searchInput");
			// Membuat setting pointer awal untuk body table
			// Jika table kosong maka pointer jadi default
			// Jika table terisi maka pointer diubah menjadi pointer
			changeCursor(); 
 
			// Fungsi untuk menangani klik pada row pada TableAddPaper(unselected paper)
			// Menyimpan data klik pada table 
			$('#TableAddPaper tbody').on('click', 'tr', function () {
				if($(this).attr("class") == 'selected1') {
					$(this).css("background-color", ""); 
					$(this).removeClass();
					counter--;
					delete dataPindah1[counter][0];
					delete dataPindah1[counter][1];
					delete dataPindah1[counter][2];
				} else {
					$('#TableAddPaper tbody tr').each(function (i, row) {
						if($(row).css('background-color') == 'rgb(255, 255, 0)') {
							$(row).css('background-color',"");
						}
					});
					 
					$('#AddedPaper tbody tr').each(function (i, row) {
						if($(row).css('background-color') == 'rgb(255, 255, 0)') {
							$(row).css('background-color',"");
						}
					});
					 
					dataPindah1[counter][0] = $('td', this).eq(0).text();
					dataPindah1[counter][1] = $('td', this).eq(1).text();
					dataPindah1[counter][2] = $(this).attr('id');
					counter++;
					$(this).css({'background-color' : 'Gainsboro '});
					$(this).removeClass();
					$(this).addClass("selected1");
				}
			});
		 
			$('.searchInput').focus(function(){
				$('#AddedPaper tbody tr').each(function (i, row) {
					if($(row).css('background-color') == 'rgb(255, 255, 0)') {
						$(row).css('background-color', "");
					}
				});
				$('#TableAddPaper tbody tr').each(function (i, row) {
					if($(row).css('background-color') == 'rgb(255, 255, 0)') {
						$(row).css('background-color',"");
					}
				}); 
			});

			$('#AddedPaper tbody').on('click', 'tr', function () {
				if($(this).attr("class") == 'selected2') {
					$(this).css("background-color","");
					$(this).removeClass();
					counter1--;
					 
					delete dataPindah2[counter1][0];
					delete dataPindah2[counter1][1];
					delete dataPindah2[counter1][2];
				} else {
					$('#AddedPaper tbody tr').each(function (i, row) {
						if($(row).css('background-color') == 'rgb(255, 255, 0)') {
							$(row).css('background-color',"");
						}
					});
					$('#TableAddPaper tbody tr').each(function (i, row) {
						if($(row).css('background-color') == 'rgb(255, 255, 0)') {
							$(row).css('background-color',"");
						}
					});
				 
					// ClearTimeout(time);
					dataPindah2[counter1][0] = $('td', this).eq(0).text();
					dataPindah2[counter1][1] = $('td', this).eq(1).text();
					dataPindah2[counter1][2] = $(this).attr('id');
				 
					counter1++;
					$(this).css({'background-color' : 'Gainsboro '});
					$(this).removeClass();
					$(this).addClass("selected2");
				}
			});

			$("#rightButton").click(function() {
				//clearTimeout(time);
				if(typeof dataPindah1[0][0] !== 'undefined') {
					if(typeof rowNode1[0] !== 'undefined') {
						for(var i = 0; i < counter2; i++) {
							$(rowNode1[i]).removeAttr("style");
						}
						counter2 = 0;
					}
				 
					var json;
					json = "[";
					for(var i = 0; i < counter; i++) {
						if(i == counter - 1) {
							json = json + "{\"judul\":\"" + dataPindah1[i][0] + "\",\"peneliti\":\"" + dataPindah1[i][1] + "\"}";
						} else {
							json = json + "{\"judul\":\"" + dataPindah1[i][0] + "\",\"peneliti\":\"" + dataPindah1[i][1] + "\"},";
						}
					}
				 
					json = json + "]";
					json = JSON.parse(json);
				 
					var rownode = t.fnAddData(json);
					for(var i = 0; i < counter; i++) {
						var theNode = $('#AddedPaper').dataTable().fnSettings().aoData[rownode[i]].nTr;
						theNode.setAttribute('id',dataPindah1[i][2]);
						$('#AddedPaper > tbody > tr').eq(rownode[i]).css('background-color', 'Yellow');
					}
				 
					table.api().row('.selected1').remove().draw();
					changeCursor(); 
					var rowpos = $('#AddedPaper tr:last').position();
				 
					$('#AddedPaperScrollBody').animate({scrollTop: rowpos.top}, "slow", function() {
						jumlahPaper = t.fnSettings().fnRecordsTotal();
						if(jumlahPaper <= 21) {}
						else {}
					});
			 
					counter2 = counter;
					counter = 0;
				}
			});

			$("#leftButton").click(function() {
				// clearTimeout(time);
				if(typeof dataPindah2[0][0] !== 'undefined') {
					if(typeof rowNode2[0] !== 'undefined') {
						for(var i = 0; i < counter3; i++) {
							$(rowNode2[i]).removeAttr("style");
						}
						counter3 = 0;
					}
				 
					var json2;
					json2 = "[";
				 
					for(var i = 0; i < counter1; i++) {
						if(i == counter1 - 1) {
							json2 = json2 + "{\"judul\":\"" + dataPindah2[i][0] + "\",\"peneliti\":\"" + dataPindah2[i][1] + "\"}";
						} else {
							json2 = json2 + "{\"judul\":\"" + dataPindah2[i][0] + "\",\"peneliti\":\"" + dataPindah2[i][1] + "\"},";
						}
					}
				 
					json2 = json2+"]";
					t.api().row('.selected2').remove().draw();
					json2 = JSON.parse(json2);
					var rownode = table.fnAddData(json2);
				 
					for(var i = 0; i < counter1; i++) {
						var theNode = $('#TableAddPaper').dataTable().fnSettings().aoData[rownode[i]].nTr;
						theNode.setAttribute('id',dataPindah2[i][2]);
						$('#TableAddPaper > tbody > tr').eq(rownode[i]).css('background-color', 'Yellow');
					}
				 
					changeCursor();

					var rowpos = $('#TableAddPaper tr:last').position();
				 
					$('#TableAddPaperScrollBody').animate({scrollTop: rowpos.top}, "slow",function() {
						jumlahPaper = t.fnSettings().fnRecordsTotal();
						if(jumlahPaper <= 21) {}
						else { }
					});
			 
					counter3 = counter1;
					counter1 = 0;
				}
			});

			$("#SaveButton").click(function() {
				jumlahPaper = t.fnSettings().fnRecordsTotal();
				// if(jumlahPaper <= 21) {
					$('.sumbuXlabel').remove();
					$('.sumbuYlabel').remove();
					var total = $('#AddedPaper tbody tr').length;
					SelectedId=$('#AddedPaper tbody tr').attr('id')+',';
					$('#AddedPaper tbody tr').each(function(index) {
						if(index==0) {}
						else {
							if(index == total - 1) {
								SelectedId = SelectedId+$(this).attr('id');
							} else {
								SelectedId = SelectedId+$(this).attr('id')+","; 
							}
						}
						$(this).css('background-color', '');
					});
			  
					$('#TableAddPaper tbody tr').each(function(index) {
						$(this).css('background-color', '');
					});
					parameter = SelectedId;
					 
					if(document.URL.indexOf("#") >= 0) {
						var location = document.URL.split("#");
						document.location.href = location[0] + '#close';
					} else {
						document.location.href = document.URL + '#close';
					}
					 
					edge = $("#edge option:selected").text();
					zooming = $("#mode_zoom option:selected").text();
					pan = $("#mode_pan option:selected").text();
					getData(defaultX, defaultY, SelectedId, edge, zooming, pan);
					jumlahPaper = t.fnSettings().fnRecordsTotal();
					$("#jumlahPaper").text(jumlahPaper);
					$("#Close").attr("href", "#close");
				// } else {
					//$('#SaveButton').attr('disabled','disabled');
				// 	alert("Jumlah paper melebihi 21. Kurangi paper");
				// }
				d3.select('.frame').remove();
			});
		};
		 
		function changeCursor() {
			if($('#AddedPaper .dataTables_empty').length) {
				$('#AddedPaper tbody tr').css({'cursor' : 'default'});
			} else {
				$('#AddedPaper tbody tr').css({'cursor' : 'pointer'});
			}
 
			if($('#TableAddPaper .dataTables_empty').length) {
				$('#TableAddPaper tbody tr').css({'cursor' : 'default'});
			} else {
				$('#TableAddPaper tbody tr').css({'cursor' : 'pointer'});
			}
		}
			 
		function initializeBreadcrumbTrail() {
			// Add the svg area.
			var trail = d3.select("#sequence").append("svg:svg")
				.attr("width", width)
				.attr("height", 50)
				.attr("id", "trail");
			//.translate(10,10);
			// Add the label at the end, for the percentage.
			trail.append("svg:text")
			.attr("id", "endlabel")
			.style("fill", "#000");
		}

		function mouseover(d) {
			var sequenceArray = getAncestors(d);
			updateBreadcrumbs(sequenceArray);
		}

		function mouseoverInit() {
			var sequenceArray = [{name:"Level 1",depth:0}];
			updateBreadcrumbs(sequenceArray);
		}

		function getAncestors(node) {
			var path = [];
			var home={name:"Level 1",depth:0};
			var current = node;
			while (current.parent) {
				path.unshift(current);
				current = current.parent;
			}
			path.unshift(home);
			return path;
		}

		function breadcrumbPoints(d, i) {
			var points = [];
			points.push("0,0");
			points.push(b.w + ",0");
			points.push(b.w + b.t + "," + (b.h / 2));
			points.push(b.w + "," + b.h);
			points.push("0," + b.h);
		 
			if (i > 0) { // Leftmost breadcrumb; don't include 6th vertex.
				points.push(b.t + "," + (b.h / 2));
			}
			return points.join(" ");
		}

		// Update the breadcrumb trail to show the current sequence and percentage.
		function updateBreadcrumbs(nodeArray) {

			// Data join; key function combines name and depth (= position in sequence).
			var g = d3.select("#trail")
				.selectAll("g")
				.data(nodeArray, function(d) { return d.name + d.depth; });

			// Add breadcrumb and label for entering nodes.
			var entering = g.enter().append("svg:g");
		 
			entering.append("svg:polygon")
			.attr("points", breadcrumbPoints);

			entering.append("svg:text")
			.attr("x", (b.w + b.t) / 2)
			.attr("y", b.h / 2)
			.attr("dy", "0.35em")
			.attr("text-anchor", "middle")
			.text(function(d) { return "Level "+(d.depth+1); });

			// Set position for entering and updating nodes.
			g.attr("transform", function(d, i) {
				return "translate(" + i * (b.w + b.s) + ", 10)";
			})
			.attr("class",function(d, i){if(nodeArray.length-1==i){return "not_click_breadcrumb"}else{return "click_breadcrumb"}})
			.on("click", function(d, i) {if(nodeArray.length-1==i){ entering.style("fill","#ddd"); }else{ zoom(nodes2[i]);
		
			updateBreadcrumbs(getAncestors(d))}});
			 
			// Remove exiting nodes.
			g.exit().remove();

			// Now move and update the percentage at the end.
			d3.select("#trail").select("#endlabel")
			.attr("x", (nodeArray.length + 0.5) * (b.w + b.s))
			.attr("y", b.h / 2)
			.attr("dy", "0.35em")
			.attr("text-anchor", "middle");

			// Make the breadcrumb trail visible, if it's hidden.
			d3.select("#trail")
			.style("visibility", "");
		}

		function group(listOfPapers, jumlahPengelompokan) {
			var paperGrouping = new Array(jumlahPengelompokan);
			if(listOfPapers.length == 3) {	
				paperGrouping[0] = new Array(2);
				paperGrouping[0] = listOfPapers[0];
				paperGrouping[0].name = listOfPapers[0].keyword;
				paperGrouping[1] = new Array(2);
				paperGrouping[1].name = "Text Categorization(2)";
				paperGrouping[1]['children'] = new Array(2);
				paperGrouping[1]['children'][0] = new Array(2);
				paperGrouping[1]['children'][0] = listOfPapers[1];
				paperGrouping[1]['children'][0].name = listOfPapers[1].keyword;
				paperGrouping[1]['children'][1] = new Array(2);
				paperGrouping[1]['children'][1] = listOfPapers[2];
				paperGrouping[1]['children'][1].name = listOfPapers[2].keyword;
			} else {                    
				for(var i = 0; i < listOfPapers.length; i++) {
					paperGrouping[i] = new Array(2);
					paperGrouping[i] = listOfPapers[i];
					paperGrouping[i].name = listOfPapers[i].keyword;
				}
			}
			return paperGrouping;
		}

		function getChildren(papers) {
			var newPapers = new Array(papers.length);
			for(var i = 0; i < papers.length; i++) {
				if(papers[i]['id'].length == 3) {
					newPapers[i] = papers[i];
					var children = new Object();
					children = group(papers[i].children, 2);
					newPapers[i].children = children;
				}
				else if(papers[i]['id'].length > 1) {
					newPapers[i] = papers[i];
					var children = new Object();
					children = group(papers[i].children, papers[i].children.length);
					newPapers[i].children = children;
				}
				else {
					newPapers[i] = papers[i];
				}
			}
			return newPapers;
		}
 
		$("#save_paper").click(function() {
			$("#save_map_name").click(function(){
				map_name = $('#map_name').val();
				if(map_name == '') {
					alert("Nama map harus diisi");
				}
				else {
					sumbuX = $("#sumbuX option:selected").text();
					sumbuY = $("#sumbuY option:selected").text();
					edge = $("#edge option:selected").text();
					pan = $("#mode_pan option:selected").text();
					saveData(userID,SelectedId,sumbuX,sumbuY,edge, map_name,pan);
					$( "#map_name" ).val('');
				}
			});
			$('a[href="#close"]').click(function(){
				$( "#popup-content" ).empty();
					$( "#map_name" ).val('');
			});
			$('a[href="#x"]').click(function(){
				$( "#popup-content" ).empty();
				$( "#map_name" ).val('');
			});
		});
					 
		function saveData(userID, paperID, sumbuX, sumbuY, relation, map_name, pan) {
			window.xmlhttp = getXmlHttpRequest();
			if(!window.xmlhttp)
				return;
			window.xmlhttp.open('POST', 'index.php?r=metadataPenelitian/saveData ', true);
			var query =  'userID=' + userID + '&paperID=' + paperID + '&sumbuX=' + sumbuX + '&sumbuY=' + sumbuY + '&relation=' + relation + '&map_name=' + map_name + '&mode_pan=' + pan;
			 
			window.xmlhttp.onreadystatechange = function() {
				if(window.xmlhttp.readyState == 4 && window.xmlhttp.status == 200) {
					var response = window.xmlhttp.responseText;
					if(response == '1') {
						alert("Penyimpanan berhasil");
						if(document.URL.indexOf("#") >= 0) {
							var location=document.URL.split("#");
							document.location.href=location[0]+'#close';
						}
						else {
							document.location.href=document.URL+'#close';
						}
					}
					else {
						alert("Penyimpanan gagal. Coba lagi");
					}
					//drawTablePaper(response);
				}
			};
			window.xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			window.xmlhttp.send(query);
		}
	</script>

	<!-- popup form #1 -->
	<a href="#x" class="overlay" id="AddPaper"></a>
	<div class="popup">
		<div class="content_popup">
			<!-- <h5>Catatan : Jumlah paper yang dapat divisualisasikan maksimal <strong>21</strong> paper</h5> -->
			<div class="LeftPopUp" style="float:left">
				<h2>Unselected Paper</h2>
				<!--<p>Please enter your login and password here</p>-->
				<table cellpadding="0" cellspacing="0" border="0" id="TableAddPaper">
					<thead>
						<tr>
							<th>Judul</th>
							<th>Peneliti</th>
						</tr>
					</thead>
				</table>
			</div>

			<div style="top:50%; position:absolute;left:48%">
				<button type="button" id="rightButton" class="btn btn-default btn-sm">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</button>
				<br/>
				<button type="button" id="leftButton" class="btn btn-default btn-sm" style="margin-top:10px">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</button>
			</div>

			<div class="RightPopUp" style="float:right">
				<h2 id="SelectedPaper">Selected Paper</h2>
				<table cellpadding="0" cellspacing="0" border="0" id="AddedPaper">
					<thead>
						<tr>
							<th>Judul</th>
							<th>Peneliti</th>
						</tr>
					</thead>

					<tbody id="SelectedRow"></tbody>
				</table>
			</div>
		</div>

		<button id="SaveButton" class="button"style="float:right;margin-right:10px;width:auto">Simpan</button>
		<a class="close" href="#close" id="Close"></a>
	</div>

	<!-- popup form #2 -->
	<a href="#x" class="overlay" id="ShowDetailPaper"></a>
	<div class="popup" style ="width:800px;">
		<h2>Detail Paper</h2>
		<div id="popup-content"></div>
		<a class="close" href="#close" id="closeDetail"></a>
	</div>

	<a href="#x" class="overlay" id="SavePaper"></a>
	<div class="popup" style ="width:300px;">
		<h2>Simpan Peta</h2>
		<div style="margin-top:20px">
			<label>Nama Peta : </label>
			<input type="text" class="saveInput" id="map_name"></input>
			<div>
				<button class="button" id="save_map_name" style="width:70px; float:right; margin-top:20px; margin-right:10px">Simpan</button>
			</div>
		</div>
		<a class="close" href="#close" id="closeDetail"></a>
	</div>
	
	<!-- Popup help for zooming -->
	<a href="#helpZoom" class="overlay" id="helpZooming"></a>
	<div class="popup" style ="width:600px;">
		<h2>Mode Zoom</h2>
		<div id="popup-content">
			Tooltip diaktifkan dengan cara melakukan hover selama 1 detik<br>
			<br>
			Lingkaran dengan jumlah data:<br>
			1. <b>1</b> saat dipilih akan ditampilkan <b>popup</b> yang berisi <b>detail rinci data penelitian</b><br>
			2. <b>lebih dari 1</b> saat dipilih akan ditampilkan <b>lingkaran baru</b> yang telah dikelompokan <br>
			<br>
			<font size="3" color="#3B5998"><b>Fisheye + Semantic</b><br></font>
			Lingkaran baru ada pada <b>view yang sama</b><br>
			<b>Fisheye zoom</b> diaktifkan dengan cara melakukan <b>hover</b><br>
			<b>Semantic zoom</b> diaktifkan dengan cara melakukan <b>klik</b> pada data tidak tunggal<br>
			Untuk menutup semantic zoom <b>klik data sebelumnya</b> atau <b>klik lingkaran lain (jumlah data lebih dari 1)</b>
			<br><br>
			<font size="3" color="#3B5998"><b>Breadcrumbs</b><br></font>
			Lingkaran baru ada pada <b>view baru</b><br>
			<img id="home" src="http://localhost/citationnetwork/ta_updated/images/breadcrumb.png" height="30\" style="float:left;margin-right:10px;margin-bottom:10px"></img><br><br><br>
			Untuk kembali ke <b>data sebelumnya</b> pengguna dapat melakukan klik pada <b>breadcrumb</b><br>
			Untuk kembali ke <b>peta penelitian</b> pengguna dapat melakukan klik pada <b>icon rumah (home)</b><br>
		</div>
		<a class="close" href="#close" id="closeHelpZoom"></a>
	</div>

	<!-- Popup help for panning -->
	<a href="#helpPan" class="overlay" id="helpPanning"></a>
	<div class="popup" style ="width:600px;">
		<h2>Mode Pan</h2>
		<div id="popup-content">
			Tombol ini digunakan untuk mengubah mode <i>panning</i> pada peta penelitian.<br><br>
			Terdapat dua mode <i>pan</i>, yaitu:<br><br>
			<font size="3" color="#3B5998"><b>1. Linier</b><br></font>
				Pada mode pan Linier, <i>panning</i> dapat dilakukan dengan cara: <br>
				- <b>Klik pada area peta penelitian</b> (bukan pada lingkaran), dan kemudian <b>tarik/geser area peta tersebut</b> ke arah yang diinginkan (<i>Grab and Drag</i>). <br><br><b>Atau</b><br><br>
				- <b>Geser kotak kecil</b> pada <i>overview map</i> (peta berskala lebih kecil) yang berada di kiri atas, di bawah tombol "Reset Pan" (<i>Navigation window</i>).<br><br>
				Untuk mengembalikan peta pada posisi semula, tekan tombol "Reset Pan".<br><br>
			<font size="3" color="#3B5998"><b>2. Distorsi</b><br></font>
				Pada mode pan Distorsi, <i>panning</i> dapat dilakukan dengan cara: <br>
				- <b>Tekan tombol Ctrl</b> pada <i>keyboard</i> 
				dan <b>arahkan kursor</b> pada lingkaran tertentu untuk dipilih dan dijadikan fokus.<br><br>
		</div>
		<a class="close" href="#close" id="closeHelpPan"></a>
	</div>
</body>