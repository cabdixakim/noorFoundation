@extends('layouts.profileMaster')
  
@section('content')    
{{-- start of plan form --}}
<!-- component -->
@if (session('status'))
<div class="flex justify-center items-center ">
  <div class="alert alert-success   mb-8 mt-5" role="alert">
    {{ session('status') }}
</div>
</div>
@endif
<div class="w-full mt-5 max-w-xs sm:max-w-full sm:flex sm:mt-5">

<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ml-16 sm:m-auto sm:w-2/5 " action=" {{route('update-student-plan.update', $student->id)}}" method="POST">
         @method('PATCH')
          @csrf
    
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="university_name">
              name of university
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('university_name',$student->plan->university_name ?? '')}}" name="university_name" type="text" placeholder="mogadishu unversity">
           @error('university_name')
             <p class="text-red-500 text-xs italic">Please choose universty name.</p>
            @enderror
          </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="faculty">
              Faculty
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('faculty', $student->plan->faculty ?? '')}}" name="faculty" type="text" placeholder="e.g engineering">
           @error('faculty')
             <p class="text-red-500 text-xs italic">Please choose your faculty.</p>
            @enderror
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="semester">
              semester
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"value="{{old('semester',$student->plan->semester ?? '')}}"  name="semester" type="text" placeholder="1">
            @error('semester')
            <p class="text-red-500 text-xs italic">Please choose your current semester.</p>
            @enderror
                
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="semester_start">
              when will semester start?
            </label>
            <div class="flex items-start ">
              <input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-min-view-mode="months" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('semester_start',$student->plan->semester_start ?? '')}}" name="semester_start" type="text" placeholder="2020/2/19">
              <span class=""><i class="far fa-calendar-alt fa-2x  ml-2 h-full"></i></span>
            </div>
    
           @error('semester_start')
           <p class="text-red-500 text-xs italic">Please choose a start date</p>
           @enderror
               
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="semester_end">
             when will the semester end?
            </label>
            <div class="flex items-start ">
                <input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-min-view-mode="months" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('semester_end',$student->plan->semester_end ?? '')}}" name="semester_end" type="text" placeholder="2020/6/19">
                <span class=""><i class="far fa-calendar-alt fa-2x  ml-2 h-full"></i></span>
            </div>
            @error('semester_end')
            <p class="text-red-500 text-xs italic">Please choose end date</p>
           @enderror
          </div>
          <div class="mb-6">
            <small class="text-red-500">only the admin(you) can update this field</small>
            <label class="block text-gray-700 text-sm font-bold mb-2" for="graduation_date">
              graduation date
            </label>
            <div class="flex items-start ">
                <input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-min-view-mode="months" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('graduation_date',$student->plan->graduation_date ?? '')}}" name="graduation_date" type="text" placeholder="2020/6/19">
                <span class=""><i class="far fa-calendar-alt fa-2x  ml-2 h-full"></i></span>
            </div>
            @error('graduation_date')
            <p class="text-red-500 text-xs italic">Please choose graduation date</p>
           @enderror
               
          </div>
         
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="amount_per_semester">
              amount of money needed per year
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"value="{{old('amount_per_semester',$student->plan->amount_per_semester ?? '')}}"   name="amount_per_semester" type="number" placeholder="400">
             @error('amount_per_semester')
              <p class="text-red-500 text-xs italic">Please choose amount needed for a semester</p>
              @enderror   
          </div>
          
          <div class="flex items-center sm:justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 sm:text-white font-bold py-2 whitespace-no-wrap px-4 rounded focus:outline-none focus:shadow-outline hover:bg-blue-600" type="submit">
             Update Plan
            </button>
          </div>
        </form>
      </div>
      {{-- end of plan form --}} 
      
  </div>

@endsection