@extends('layouts.app')
@section('content')
<div class="container">
  <div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
           خدمات الدكتور
        </div> 
       <br>
       <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">operation</th>
          </tr>
        </thead>
        <tbody>
          @if (isset($services) && $services->count() > 0)
              @foreach ($services as $service)
              <tr>
              <th scope="row">{{$service->id}}</th>
              <td>{{$service->name}}</td>
              <td><a href="#" class="btn btn-danger">حذف الخدمة</a></td>
              </tr>
              @endforeach
          @endif

        </tbody>
      </table>

      <br><br>
    <form method="POST" action="{{route('save.doctors.services')}}">
        @csrf
        <div class="form-group">
          <label for="doctor_id">اختر طبيب</label>
            <select class="form-control" name="doctor_id">
              @if (isset($doctors) && $doctors->count() >0)
                  @foreach ($doctors as $doctor)
                    <option value="{{$doctor->id}}"> {{$doctor->name}}</option>
                  @endforeach
              @endif
            </select>
        </div>

          <div class="form-group">
            <label for="servicesIds[]">اختر الخدمات</label>
              <select class="form-control" name="servicesIds[]" multiple>
                @if (isset($allServices) && $allServices->count() >0)
                  @foreach ($allServices as $allService)
                    <option value="{{$allService->id}}"> {{$allService->name}}</option>
                  @endforeach
                @endif
              </select>
            </div>


 



            <button type="submit" class="btn btn-primary">Save</button>
          </form>
    </div>
  </div>
</div>
@stop 

