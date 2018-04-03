@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Companycategory
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($companycategory, ['files' =>  true ,'route' => ['companycategories.update', $companycategory->id], 'method' => 'patch']) !!}

                        @include('admin.companycategories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection