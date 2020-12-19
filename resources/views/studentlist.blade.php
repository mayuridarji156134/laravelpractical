@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-12">
            <div class="row">
            @if(Session::has('success_message'))
                <div class="alert alert-success">
                    {{ Session::get('success_message') }}
                </div>
            @endif
            @if(Session::has('error_message'))
                <div class="alert alert-danger">
                    {{ Session::get('error_message') }}
                </div>
            @endif
            </div>
            <div class="card">
              
                <a href="{{route('student.add')}}" class="btn btn-primary" style="margin-bottom: 10px;"> Add Student</a>
                <div class="card-header">Student Listing</div>

                <div class="card-body">
                    <table id="student-table">
                        <thead>
                            <tr>
                              <th>SNo.</th>
                              <th>Name</th>
                              <th>Grade</th>
                              <th>City</th>
                              <th>Country</th>
                              <th>DOB</th>
                              <th>Address</th>
                              <th>Image</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">

  $('#student-table').DataTable({
    processing: true,
    serverSide: true,
    pagination: true,
    ajax: '{!! route('student.data') !!}',
    columns: [
      { data: 'id', name: 'id' ,'sortable':false},
      { data: 'name', name: 'name' ,'sortable':true},
      { data: 'grade', name: 'grade' ,'sortable':true},
      { data: 'city', name: 'city','sortable':false},
      { data: 'country', name: 'country' ,'sortable':false},
      { data: 'dob', name: 'dob'  ,'sortable':true},
      { data: 'address', name: 'address','sortable':false},
      { name: 'photo' ,'sortable':false,render: function ( data, type, row ) {
            return "<img src='{{asset('/storage/Studentphotos/')}}"+'/'+row.photo+"' height='50px' width='50px'>";
        }},
    ]
  });

</script>
@endsection
