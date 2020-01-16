@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    
<div class="row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
              <h3 class="card-title">All Quizzes</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
              <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  {{-- <div class="row">
                      <div class="col-sm-12 col-md-6">
                          <div class="dataTables_length" id="example1_length">
                              <label>Show
                                  <select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm">
                                      <option value="10">10</option>
                                      <option value="25">25</option>
                                      <option value="50">50</option>
                                      <option value="100">100</option>
                                  </select> entries</label>
                          </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                          <div id="example1_filter" class="dataTables_filter">
                              <label>Search:
                                  <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1">
                              </label>
                          </div>
                      </div>
                  </div> --}}
                  <div class="row">
                      <div class="col-sm-12">
                          <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                              <thead>
                                  <tr role="row">
                                      <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 170px;">id</th>
                                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 220px;">Title</th>
                                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 194px;">Count</th>
                                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 144px;">Duration</th>
                                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">Date(created)</th>
                                      <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 194px;">Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($quizzes as $quiz)                                      
                                    <tr role="row">
                                        <td class="sorting_1">{{ $quiz->id}}</td>
                                        <td>{{ $quiz->title}}</td>
                                        <td>{{ $quiz->nQs }}</td>
                                        <td>{{ $quiz->duration }}</td>
                                        <td>{{ $quiz->start_on }}</td>
                                        <td>
                                          <a href="{{route('admin.quiz.edit',$quiz->id)}}" class="btn btn-sm btn-success">Edit</a>
                                          <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                  @endforeach
                              </tbody>
                              <tfoot>
                                  <tr>
                                      <th rowspan="1" colspan="1">id</th>
                                      <th rowspan="1" colspan="1">Title</th>
                                      <th rowspan="1" colspan="1">Count</th>
                                      <th rowspan="1" colspan="1">Duration</th>
                                      <th rowspan="1" colspan="1">Date(created)</th>
                                      <th rowspan="1" colspan="1">Action</th>
                                  </tr>
                              </tfoot>
                          </table>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-sm-12 col-md-5">
                          <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1* to 10* of 57* entries</div>
                      </div>
                      <div class="col-sm-12 col-md-7">
                          <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                              {{$quizzes->links()}}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- /.card-body -->
      </div>
      <!-- /.card -->
  </div>
  <!-- /.col -->
</div>

@endsection