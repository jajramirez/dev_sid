@extends('template.pages.main')

@section('title')
    Nuevo Expediente
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('template/plugins/datepicker/datepicker3.css')}}">
	<link rel="stylesheet" href="{{ asset('template/plugins/select2/select2.min.css')}} ">
@endsection

@section('name_aplication')
    <h1>
        Crear Expediente
        <small> </small>
    </h1>
@endsection


@section('content')

@if(count($errors) >0)
	<div class="alert alert-danger" role="alert">
		<ul>
			@foreach($errors->all() as $error)
				<li>
					{{ $error}}
				</li>
			@endforeach
		</ul>
	</div>
@endif

	{!! Form::open(['route' => 'expedientes.store' , 'method' => 'POST', 'files'=>true]) !!}


	 <div class="col-md-12">

          <div class="box box-info">
            <div class="box-header">
              
            </div>
            <div class="box-body">

            	<div class='form-group col-md-12'>
					{!! Form::label('TRD', 'Código TRD')!!}
					{!! Form::text('TRD', null, ['class' => 'form-control' , 'placeholder' => '', 'disabled', 'id' => 'TRD'])!!}
				
				</div>


            	<div class="form-group col-md-4">
			     	<label>Oficina Productora</label>
			        <select id='COD_ORGA' name='COD_ORGA' class="form-control select2" style="width: 100%;" required onchange="codigoTRD()">
			        	<option value="">Seleccione una opcion</option>
			          	@foreach($orgas as $orga)
							<option value="{{$orga->COD_ORGA}}">{{$orga->NOM_ORGA}}</option>
			            @endforeach
			        </select>
			    </div>
				

              	<div class="form-group col-md-4">
			        <label>Código Serie</label>
			        <select name='COD_SERI' id='COD_SERI' class="form-control select2" style="width: 100%;" required onchange="cargarSubs()">
			        	<option value="">Seleccione una opcion</option>
			           	@foreach($series as $seri)
							<option value="{{$seri->COD_SERI}}">{{$seri->NOM_SERI}}</option>
			            @endforeach
			        </select>
			    </div>

			    
				<div class='form-group col-md-4'>
					{!! Form::label('COD_SUBS', 'Sub Serie')!!}
					<select id="COD_SUBS" name='COD_SUBS' class="form-control select2" style="width: 100%;" onchange="codigoTRD()">
					        <option value="">Seleccione una subserie</option>
					</select>
				</div>


				<div class='form-group col-md-4'>
					<label id="met8">Modalidad</label>
					{!! Form::text('NOM_MODA', null, ['class' => 'form-control' , 'placeholder' => '' , 'id' => 'text8'])!!}
				</div>

				<div class='form-group col-md-4'>
					<label id="met7">Programa Académico</label>
					{!! Form::text('NOM_PROG', null, ['class' => 'form-control' , 'placeholder' => '', 'pattern' => '[a-zA-Z0-9.àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]+[ a-zA-Z0-9.,#-_+àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]*$', 'title'=>'El campo no puede estar en blanco', 'id'=>'NOM_PROG'])!!}
				</div>

					<div class='form-group col-md-4'>
					<label id="met10">Fecha Ingreso</label>
						<div class="input-group date">
	                        <div class="input-group-addon">
	                            <i class="fa fa-calendar"></i>
	                        </div>
	                        <input id="text10" type="text" class="form-control pull-right" id="datepicker" name="FEC_INGR">
                    	</div>
				
				</div>

					<div class='form-group col-md-4'>
					<label id="met11">Año Finalizacion</label>
					{!! Form::text('ANH_FINA', null, ['class' => 'form-control' , 'placeholder' => '', 'maxlength'=>'4','pattern' => '^[0-9]*$', 'title' => 'Solo se permiten números', 'id' => 'text11' ])!!}
				</div>


				<div class='form-group col-md-4'>
					<label id="met9">Nivel</label>
					{!! Form::text('TIP_NIVEL', null, ['class' => 'form-control' , 'placeholder' => '' , 'id' => 'text9'])!!}
				</div>

				<div class='form-group col-md-4'>
					{!! Form::label('OBS_GENE', 'Obseraciones')!!}
					{!! Form::text('OBS_GENE', null, ['class' => 'form-control' , 'placeholder' => ''])!!}
				</div>
            </div>
 
          </div>

        </div>


	



	<div class="row">
       
		<div class="col-md-6">
			<div class="box box-default">
        <div class="box-header with-border">    
          <div class="box-tools pull-right">
           <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
             
				<div class="form-group">
			     	<label id="met2">Tipo Documento</label>
			        <select id="TIP_DOCU" name='TIP_DOCU' class="form-control select2" style="width: 100%;" required>
			            <option value="">Seleccione una opcion</option>
			          	<option value="CC">Cédula de Ciudadanía</option>
						<option value="CE">Cédula de Extranjería</option>
						<option value="RC">Registro civil</option>
						<option value="TI">Tarjeta de identidad</option>
						<option value="NIT">NIT para personas jurídicas</option> 
			        </select>
			    </div>

				<div class='form-group'>
					<label id="met1"> Número Documento</label>

					{!! Form::text('NUM_DOCU', null, ['class' => 'form-control' , 'placeholder' => '', 'required' ,'pattern' => '^[0-9]*$', 'title' => 'Solo se permiten números', 'id' => 'text1'])!!}
				</div>

				<div class='form-group' >
					
					<label id="met3">Primer Nombre</label>
					{!! Form::text('PRI_NOMB', null, ['class' => 'form-control' , 'placeholder' => '', 'pattern' => '[a-zA-Z0-9.àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]+[ a-zA-Z0-9.,#-_+àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]*$', 'title'=>'El campo no puede estar en blanco', 'id' => 'text3'])!!}
				</div>

            </div>
            <!-- /.col -->
            <div class="col-md-12">

            	<div class='form-group' >
					<label id="met4">Segundo Nombre</label>
					{!! Form::text('SEG_NOMB', null, ['class' => 'form-control' , 'placeholder' => '', 'pattern' => '[a-zA-Z0-9.àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]+[ a-zA-Z0-9.,#-_+àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]*$', 'title'=>'El campo no puede estar en blanco', 'id' => 'text4'])!!}
				</div>	
				<div class='form-group' >
					<label id="met5">Primer Apellido</label>
					{!! Form::text('PRI_APEL', null, ['class' => 'form-control' , 'placeholder' => '', 'pattern' => '[a-zA-Z0-9.àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]+[ a-zA-Z0-9.,#-_+àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]*$', 'title'=>'El campo no puede estar en blanco' , 'id' => 'text5'])!!}
				</div>	
				<div class='form-group' >
					<label id="met6">Segundo Apellido</label>
					{!! Form::text('SEG_APEL', null, ['class' => 'form-control' , 'placeholder' => '', 'pattern' => '[a-zA-Z0-9.àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]+[ a-zA-Z0-9.,#-_+àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð]*$', 'title'=>'El campo no puede estar en blanco', 'id' => 'text6'])!!}
				</div>	

            </div>

          </div>

        </div>

        <div class="box-footer">
        
        </div>
      </div>
		</div>
         <div class="col-md-6">

          <div class="box box-info">
            <div class="box-header">
              
            </div>
            <div class="box-body">
             		<div class='form-group'>
						{!! Form::label('NOM_ARCH', 'Archivo')!!}
						{!! Form::File('NOM_ARCH', null, ['required', 'id'=> 'NOM_ARCH'])!!}
					</div>
				<div class='form-group'>
					{!! Form::label('FEC_ARCH', 'Fecha Creación del Archivo')!!}
							<div class="input-group date">
	                        <div class="input-group-addon">
	                            <i class="fa fa-calendar"></i>
	                        </div>
	                        <input type="text" class="form-control pull-right" id="datepicker2" name="FEC_ARCH">
                    	</div>
				</div>

					<div class='form-group'>
					{!! Form::label('NUM_PAGI', 'Paginas')!!}
					{!! Form::text('NUM_PAGI', null, ['class' => 'form-control' , 'placeholder' => '', 'pattern' => '^[0-9]*$', 'title' => 'Solo se permiten números'])!!}
				</div>

					<div class='form-group'>
					{!! Form::label('NUM_TAMA', 'Tamaño (kilobyte)')!!}
					{!! Form::text('NUM_TAMA2', null, ['class' => 'form-control' , 'placeholder' => '', 'id'=>'NUM_TAMA2', 'disabled'])!!}
					<input type="text" name="NUM_TAMA" id="NUM_TAMA" style="display:none">
				</div>


				<div class='form-group'>
					{!! Form::label('NOM_SOFT', 'Software')!!}
					{!! Form::text('NOM_SOFT', null, ['class' => 'form-control' , 'placeholder' => '', 'required'])!!}
				</div>

				<div class='form-group'>
					{!! Form::label('NOM_VERS', 'Versión')!!}
					{!! Form::text('NOM_VERS', null, ['class' => 'form-control' , 'placeholder' => '', ''])!!}
				</div>

				<div class='form-group'>
					{!! Form::label('NOM_RESO', 'Resolución')!!}
					{!! Form::text('NOM_RESO', null, ['class' => 'form-control' , 'placeholder' => '', ''])!!}
				</div>

				<div class='form-group'>
					{!! Form::label('NOM_IDIO', 'Idioma')!!}
					{!! Form::text('NOM_IDIO', null, ['class' => 'form-control' , 'placeholder' => '', ''])!!}
				</div>

            </div>
            
          </div>

        </div>

        
      </div>


	
	
	

	<div class='form-group'> 
		{!! Form::submit('Registrar',['class' => 'btn btn-primary'] )!!}
	</div>

	{!! Form::close() !!}

@endsection


@section('js')
	<script src="{{ asset('template/plugins/select2/select2.full.min.js')}}"></script>
		<script src="{{ asset('template/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
	<script type="text/javascript">

	 $('#NOM_ARCH').change(function (){
     var sizeByte = this.files[0].size;
     var siezekiloByte = parseInt(sizeByte / 1024);
     $("#NUM_TAMA").val(siezekiloByte);
     $("#NUM_TAMA2").val(siezekiloByte);

     
 	});


			$('#datepicker').datepicker({
		autoclose: true
	});
			$('#datepicker2').datepicker({
		autoclose: true
	});

		  $(".select2").select2();




		function cargarSubs()
		{
			var cod_seri = $("#COD_SERI").val();
			codigoTRD();
			var PostUri = "{{ route('seris.buscarccd')}}"; 

			$.ajax({
			    url: PostUri,
			    type: 'post',
			    data: {
			        cod_seri: cod_seri
			    },
			    headers: {
			        'X-CSRF-TOKEN': "{{ Session::token() }}", //for object property name, use quoted notation shown in second
			    },
			    success: function (data) {
			    	var comilla = '"';
			    	if(data != "<option value="+comilla+comilla+">Seleccione una subserie</option>")
			    	{
			    	
			    		$("#COD_SUBS").attr('required', 'required');
			    	}
			    	else
			    	{
			    		$("#COD_SUBS").removeAttr('required');
			    	}

		
			        $("#COD_SUBS").html(data); 

			    }
			});

		}




	function codigoTRD()
	{

		var oficina = $("#COD_ORGA").val();
		var cod_seri = $("#COD_SERI").val();
		if(cod_seri.length > 	0)
		{
			cod_seri = '.'+$("#COD_SERI").val();
			
		}	
		
		var cod_subs = $("#COD_SUBS").val();
		if(cod_subs.length > 0)
		{
			cod_subs = '.'+$("#COD_SUBS").val();
			
		}	
		encabezados();
		var trd = oficina+cod_seri+cod_subs;
		$("#TRD").val(trd);
	}

	function encabezados()
		{
			var cod_seri = $("#COD_SERI").val();
			var cod_subs = $("#COD_SUBS").val();
			var PostUri = "{{ route('expedientes.buscarencabezado')}}"; 

			$.ajax({
			    url: PostUri,
			    type: 'post',
			    data: {
			        COD_SERI: cod_seri,
			        COD_SUBS: cod_subs
			    },
			    headers: {
			        'X-CSRF-TOKEN': "{{ Session::token() }}", //for object property name, use quoted notation shown in second
			    },
			    success: function (data) {
			    	if(data != 'null')
			    	{
			    		var labeltexto = JSON.parse(data);

			    		$("#met1").html(labeltexto.MET1);
			    		if(labeltexto.MET1 == null)
			    		{
			    		
			    			$("#text1").prop( "disabled", true );
			    		}
			    		else
			    		{
			    			$("#text1").prop( "disabled", false );
			    		}
			    		$("#met2").html(labeltexto.MET2);
			    		
			    		if(labeltexto.MET2 == null)
			    		{
			    		
			    			$("#TIP_DOCU").prop( "disabled", true );
			    		}
			    		else
			    		{
			    			$("#TIP_DOCU").prop( "disabled", false );
			    		}
			    		$("#met3").html(labeltexto.MET3);
			    			if(labeltexto.MET3 == null)
				    		{
				    		
				    			$("#text3").prop( "disabled", true );
				    		}
				    		else
				    		{
				    			$("#text3").prop( "disabled", false );
				    		}
				    	$("#met4").html(labeltexto.MET4);
				    	if(labeltexto.MET4 == null)
				    		{
				    		
				    			$("#text4").prop( "disabled", true );
				    		}
				    		else
				    		{
				    			$("#text4").prop( "disabled", false );
				    		}
			    		$("#met5").html(labeltexto.MET5);
			    		if(labeltexto.MET5 == null)
				    		{
				    		
				    			$("#text5").prop( "disabled", true );
				    		}
				    		else
				    		{
				    			$("#text5").prop( "disabled", false );
				    		}
			    		$("#met6").html(labeltexto.MET6);
			    		if(labeltexto.MET6 == null)
				    		{
				    		
				    			$("#text6").prop( "disabled", true );
				    		}
				    		else
				    		{
				    			$("#text6").prop( "disabled", false );
				    		}
			    		$("#met7").html(labeltexto.MET7);
				    		if(labeltexto.MET7 == null)
					    		{
					    		
					    			$("#NOM_PROG").prop( "disabled", true );
					    		}
					    		else
					    		{
					    			$("#NOM_PROG").prop( "disabled", false );
					    		}

			    		$("#met8").html(labeltexto.MET8);
			    			if(labeltexto.MET8 == null)
				    		{
				    		
				    			$("#text8").prop( "disabled", true );
				    		}
				    		else
				    		{
				    			$("#text8").prop( "disabled", false );
				    		}

			    		$("#met9").html(labeltexto.MET9);
			    			if(labeltexto.MET9 == null)
				    		{
				    		
				    			$("#text9").prop( "disabled", true );
				    		}
				    		else
				    		{
				    			$("#text9").prop( "disabled", false );
				    		}
			    		$("#met10").html(labeltexto.MET10);
			    			if(labeltexto.MET10 == null)
				    		{
				    		
				    			$("#text10").prop( "disabled", true );
				    		}
				    		else
				    		{
				    			$("#text10").prop( "disabled", false );
				    		}
			    		$("#met11").html(labeltexto.MET11);
			    			if(labeltexto.MET11 == null)
				    		{
				    		
				    			$("#text11").prop( "disabled", true );
				    		}
				    		else
				    		{
				    			$("#text11").prop( "disabled", false );
				    		}
			    		
			    		
			    		$("#TIP_DOCU").removeAttr('required');
			    		$("#NOM_PROG").removeAttr('required');
			    	}
			    	else
			    	{
			    		$("#met1").html("Número Documento");
			    		$("#met2").html("Tipo Documento");
			    		$("#met3").html("Primer Nombre");
			    		$("#met4").html("Segundo Nombre");
			    		$("#met5").html("Primer Apellido");
			    		$("#met6").html("Segundo Apellido");
			    		$("#met7").html("Programa Académico");
			    		$("#met8").html("Modalidad");
			    		$("#met9").html("Nivel");
			    		$("#met10").html("Fecha Ingreso");
			    		$("#met11").html("Año Finalizacion");
			    		//2
			    		$("#TIP_DOCU").attr('required', 'required');
			    		//7
			    		$("#NOM_PROG").attr('required', 'required');

			    		$("#TIP_DOCU").prop( "disabled", false );
			    		$("#NOM_PROG").prop( "disabled", false );
			    		$("#text1").prop( "disabled", false );
			    		$("#text3").prop( "disabled", false );
			    		$("#text4").prop( "disabled", false );
			    		$("#text5").prop( "disabled", false );
			    		$("#text6").prop( "disabled", false );
			    		$("#text8").prop( "disabled", false );
			    		$("#text9").prop( "disabled", false );
			    		$("#text10").prop( "disabled", false );
			    		$("#text11").prop( "disabled", false );

			    	}

			    }
			});

		}
	</script>
@endsection
