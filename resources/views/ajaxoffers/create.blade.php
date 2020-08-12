@extends('layouts.app')
@section('content')
<div class="container">
  <div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            {{__('messages.Add your offer')}}
        </div> 
        @if (Session::has('success add'))
             <div class="alert alert-success" role="alert">
                 {{Session::get('success add')}}
          </div>
          <br>                   
        @endif
        
    <form method="POST" id="offerForm" action="{{route('ajax.offers.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="photo">{{__('messages.Select Photo')}}</label>
            <input type="file" class="form-control" name="photo">
            @error('photo')
          <small class="form-text text-danger">{{$message}}</small> 
            @enderror
          </div>
  
            <div class="form-group">
            <label for="name_ar">{{__('messages.Offer Name_ar')}}</label>
              <input type="text" class="form-control" name="name_ar" placeholder="Enter offer name">
              @error('name_ar')
            <small class="form-text text-danger">{{$message}}</small> 
              @enderror
            </div>
  
            <div class="form-group">
              <label for="name_en">{{__('messages.Offer Name_en')}}</label>
                <input type="text" class="form-control" name="name_en" placeholder="Enter offer name">
                @error('name_en')
              <small class="form-text text-danger">{{$message}}</small> 
                @enderror
              </div>
  
            <div class="form-group">
            <label for="price">{{__('messages.Offer Price')}}</label>
              <input type="text" class="form-control" name="price" placeholder="enter price">
              @error('price')
              <small class="form-text text-danger">{{$message}}</small>
              @enderror
            </div>
            <div class="form-group">
            <label for="details_ar">{{__('messages.Details_ar')}}</label>
                <input type="text" class="form-control" name="details_ar" placeholder="enter details">
                @error('details_ar')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror     
              </div>
  
              <div class="form-group">
                <label for="details_en">{{__('messages.Details_en')}}</label>
                    <input type="text" class="form-control" name="details_en" placeholder="enter details">
                    @error('details_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror     
                  </div>
  
            <button id="save_offer" class="btn btn-primary">{{__('messages.Save Offers')}}</button>
          </form>
        
    </div>
  </div>
</div>

@stop

@section('scripts') {{--ajax --}}
    <script>
      $(document).on('click','#save_offer',function (e){
        e.preventDefault();
        var formData = new FormData($(#offerForm[0]));
        $.ajax({
        type: 'post',
        enctype: 'multipart/form-data';
        url: {{route('ajax.offers.store')}},
        data: formData,
        pocessData: false,
        contentType: false,
        cache:false,
        success: function (data){

        }, error: function(reject){

        }

      });
      });
      
    </script>
@stop