@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <a href="/letters">
                <h3 class="page__heading">Forms</h3>
            </a>
        </div>
         @if ($errors->any())                                                
            <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <strong>Error!</strong>                        
                @foreach ($errors->all() as $error)                                    
                    <span class="badge badge-danger">{{ $error }}</span>
                @endforeach                        
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">List Form</h5>
                        </div>
                        <div class="card-body">
        
                        <a class="btn btn-warning" data-toggle="modal" data-target="#modalLetter" title="Click to add a new department.">Add New Letter Category</a>                        
        
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">NPK</th>
                                    <th style="color:#fff;">Name</th>
                                    <th style="color:#fff;">Letters Category</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                @foreach ($letters as $letter)
                                <tr>
                                    <td>{{ $letter->user->npk }}</td>
                                    <td>{{ $letter->user->name }}</td>
                                    <td>{{ $letter->name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('letters.show',$letter->id) }}">Detail</a>

                                        @can('edit-letter')
                                            <a class="btn btn-primary" href="{{ route('letters.edit',$letter->id) }}">Edit</a>
                                        @endcan
                                        
                                        @can('delete-letter')
                                            {!! Form::open(['method' => 'DELETE','route' => ['letters.destroy', $letter->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $letters->links() !!} 
                            </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@push('modal')
<div class="modal fade" id="modalLetter" tabindex="-1" role="dialog" aria-labelledby="modalLetterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLetterTitle">Pilih Jenis Form</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(array('route' => 'letters.apply','method'=>'POST')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">               
                    <div class="form-group">
                        <label for="">Letter Category</label>
                        {!! Form::select('letter_type_id', $letterTypes,[], array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
           
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Buat</button>
            {!! Form::close() !!}
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endpush