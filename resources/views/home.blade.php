@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    {{--button  --}}
                    <button type="button" class="col-md-1 offset-md-4 btn btn-primary "  data-target="#exampleModal" id='test1'>
                        Test1
                    </button>
                    <button type="button" class="col-md-1 btn btn-primary" data-toggle="modal" data-target="#exampleModal" id='test2'>
                       Test 2
                    </button>
                    <button type="button" class="col-md-1 btn btn-primary" data-toggle="modal" data-target="#exampleModal" id='test3'>
                        Test 3
                    </button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="col-md-6 offset-md-2" id="question"> </p>
                    <form class="col-md-6 offset-md-2" action="/form1" method="POST" id='form1'>
                        @csrf
                        <div class="form-group">
                                        <label for="name">Limit1</label>
                                        <input type="text" name="limit1" id="name" class="form-control">
                                        <span id="limit1" class="text-danger "> </span>
                        </div> 
                        <div class="form-group">              
                                        <label for="name" class="mt-3">Limit2</label>
                                        <input type="text" name="limit2" id="name" class="form-control" >
                                        <span  id="limit2" class="text-danger"></span>
                                        
                        </div>
                    </form>
                    <form class="col-md-6 offset-md-2" action="/form2" method="POST" id='form2'>
                        @csrf
                        <div class="form-group">
                                        <label for="name">Enter Text</label>
                                        <input type="text" name="text" id="name" class="form-control">
                                        <span id="text" class="text-danger"></span>
                                        
                        </div>
                    </form>
                    <form class="col-md-6 offset-md-2" action="/form3" method="POST" id='form3'>
                        @csrf
                        <div class="form-group">
                                        <label for="name">Enter num1</label>
                                        <input type="text" name="num1" id="name" class="form-control">
                                        <span id="num1" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                                        <label for="name">Enter num2</label>
                                        <input type="text" name="num2" id="name" class="form-control">
                                        <span id="num2" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                                        <label for="name">Enter num3</label>
                                        <input type="text" name="num3" id="name" class="form-control">
                                        <span id="num3" class="text-danger"></span>
                                        
                        </div>
                    </form>
                    <div class="col-md-12 mt-3">
                        <p>Result</p>
                        <p id='result'></p>

                    </div>     
                </div>
            </div>
            <div class="form-group mt-5 ">
                <button type="submit" id="submit" class="col-md-1 offset-md-6 btn btn-primary">Submit</button>
             </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        
        $('#question').html('Program to list number that remains the same when its digits are reserved ina given limit')
        $('#form2').hide();
        $('#form3').hide();
        $('#test1').click(function(){
            $('#form1').show();
            $('#form2').hide();
            $('#form3').hide();
            $('#form1').trigger("reset");
            $(this).addClass('active');
            $('#test2').removeClass('active');
            $('#test3').removeClass('active');
            $('#result').html('');
            $("#limit1").html("");
            $("#limit2").html("");
            $('#text').html('');
            $('#num1').html('');
            $('#num2').html('');
            $('#num3').html('');
        });
        $('#test2').click(function(){
            $("question").html('Reverse words and characters in a given string with out using strrev function');
            $('#form1').hide();
            $('#form2').show();
            $('#form3').hide();
            $('#form2').trigger("reset");
            $(this).addClass('active');
            $('#test1').removeClass('active');
            $('#test3').removeClass('active');
            $('#result').html('');
            $("#limit1").html("");
            $("#limit2").html("");
            $('#text').html('');
            $('#num1').html('');
            $('#num2').html('');
            $('#num3').html('');
        });
        $('#test3').click(function(){
            $('#question').html('Write a program to find number of possible unique combinations for a 3 digit number');
            $('#form1').hide();
            $('#form2').hide();
            $('#form3').show();
            $('#form3').trigger("reset");
            $(this).addClass('active');
            $('#test1').removeClass('active');
            $('#test2').removeClass('active');
            $('#result').html('');
            $("#limit1").html("");
            $("#limit2").html("");
            $('#text').html('');
            $('#num1').html('');
            $('#num2').html('');
            $('#num3').html('');
        });

        $('#submit').on('click',function(){
            $('#result').html(" ");
            var form = $('form:visible');
           
            var url = form.attr('action');
            var data = form.serialize();
            
                $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(response){
                    var result=response.result;
                    var result = result.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    $('#result').html(result);
                },
                error: function (reject) {
                if( reject.status === 422 ) {
                    var errors = $.parseJSON(reject.responseText);
                    if(errors.errors.limit1 && errors.errors.limit2 ){
                        $("#limit1").html(errors.errors.limit1[0]);
                        $("#limit2").html(errors.errors.limit2[0]);
                    }else if(errors.errors.limit1){
                        $("#limit1").html(errors.errors.limit1[0]);
                    }else if(errors.errors.limit2){
                        $("#limit2").html(errors.errors.limit2[0]);
                    }
                     if(errors.errors.text){
                        $("#text").html(errors.errors.text[0]);
                    }
                    if(errors.errors.num1 && errors.errors.num2 && errors.errors.num3){
                        $("#num1").html(errors.errors.num1[0]);
                        $("#num2").html(errors.errors.num2[0]);
                        $("#num3").html(errors.errors.num3[0]);
                    }else if(errors.errors.num1 && errors.errors.num2){
                        $("#num1").html(errors.errors.num1[0]);
                        $("#num2").html(errors.errors.num2[0]);
                    }else if(errors.errors.num2 && errors.errors.num3){
                        $("#num2").html(errors.errors.num2[0]);
                        $("#num3").html(errors.errors.num3[0]);
                    }else if(errors.errors.num1 && errors.errors.num3){
                        $("#num1").html(errors.errors.num1[0]);
                        $("#num3").html(errors.errors.num3[0]);
                    }else if( errors.errors.num1){
                        $("#num1").html(errors.errors.num1[0]);
                    }else if( errors.errors.num2){
                        $("#num2").html(errors.errors.num2[0]);
                    }else if( errors.errors.num3){
                        $("#num3").html(errors.errors.num3[0]);
                    }
                }
             }

            });
        });
        
    });
</script>
@endsection
