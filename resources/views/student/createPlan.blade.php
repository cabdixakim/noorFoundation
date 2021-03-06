@extends('layouts.profileMaster')
  
@section('content')    
{{-- start of plan form --}}
<!-- component -->
@if (session('status'))
<div class="flex justify-center items-center ">
  <div class="alert alert-success sm:w-2/5 mb-0 mt-5" role="alert">
    {{ session('status') }}
</div>
@endif
</div>
<div class="w-full mt-5 max-w-xs sm:max-w-full sm:flex sm:mt-5">
@if(empty($student->plan))
<form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ml-16 sm:m-auto sm:w-2/5 " action=" {{route('plan.store')}}" method="POST">
        
          @csrf
    
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="university_name">
              universty Name
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('university_name')}}" name="university_name" type="text" placeholder="mogadishu unversity">
           @error('university_name')
             <p class="text-red-500 text-xs italic">Please choose universty name.</p>
            @enderror
          </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="faculty">
              universty Name
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('faculty')}}" name="faculty" type="text" placeholder="engineering">
           @error('faculty')
             <p class="text-red-500 text-xs italic">Please choose your faculty.</p>
            @enderror
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="semester">
              semester
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"value="{{old('semester')}}"  name="semester" type="number" placeholder="1">
            @error('semester')
            <p class="text-red-500 text-xs italic">Please choose your current semester.</p>
            @enderror
                
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="semester_start">
               Semester Starts on?
            </label>
            <div class="flex items-start ">
              <input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-min-view-mode="months" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('semester_start')}}" name="semester_start" type="text" placeholder="2020/2/19">
              <span class=""><i class="far fa-calendar-alt fa-2x  ml-2 h-full"></i></span>
            </div>
    
           @error('semester_start')
           <p class="text-red-500 text-xs italic">Please choose a start date</p>
           @enderror
               
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="semester_end">
              semester ends on?
            </label>
            <div class="flex items-start ">
                <input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-min-view-mode="months" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('semester_end')}}" name="semester_end" type="text" placeholder="2020/6/19">
                <span class=""><i class="far fa-calendar-alt fa-2x  ml-2 h-full"></i></span>
            </div>
            @error('semester_end')
            <p class="text-red-500 text-xs italic">Please choose end date</p>
           @enderror
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="graduation_date">
              graduation date
            </label>
            <div class="flex items-start ">
                <input data-provide="datepicker" data-date-format="yyyy/mm/dd" data-date-min-view-mode="months" class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" value="{{old('graduation_date')}}" name="graduation_date" type="text" placeholder="2020/6/19">
                <span class=""><i class="far fa-calendar-alt fa-2x  ml-2 h-full"></i></span>
            </div>
            @error('graduation_date')
            <p class="text-red-500 text-xs italic">Please choose graduation date</p>
           @enderror
               
          </div>
         
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="amount_per_semester">
              amount per Year in USD
            </label>
            <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"value="{{old('amount_per_semester')}}"   name="amount_per_semester" type="number" placeholder="400">
             @error('amount_per_semester')
              <p class="text-red-500 text-xs italic">Please choose amount needed for the year</p>
              @enderror   
          </div>
          
          <div class="flex items-center sm:justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 sm:text-white font-bold py-2 whitespace-no-wrap px-4 rounded focus:outline-none focus:shadow-outline hover:bg-blue-600" type="submit">
             save plan
            </button>
          </div>
        </form>
      </div>
      {{-- end of plan form --}} 
      @else 

    
   
      <ul class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ml-16 mt-2 sm:mx-auto sm:w-2/5 ">
       <div class="sm:flex items-center justify-end sm:mb-2 mb-8">
         @if($student->plansetting->status == 'enabled')
         <a href="{{route('plan.edit',$student->id)}}" class="bg-green-400 text-gray-100 hover:text-gray-100 font-bold py-2 whitespace-no-wrap px-4 rounded focus:outline-none focus:shadow-outline hover:bg-green-600" >
             Update Plan
           </a>   
         
         @else
         <p class="text-red-500 text-xs italic">contact an admin to update plan</p>

         @endif
       </div>
        <div class="mb-6 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
         <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="firstname">
          University Name:
           </label>
         <li class=" w-2/3 font-bold py-2 pl-4 sm:ml-6 mb-2 text-gray-700 tracking-widest leading-tight  ">
           {{$student->plan->university_name}}
         </li>
         </div>
        <div class="mb-6 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
         <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="faculty">
          faculty:
           </label>
         <li class=" w-2/3 font-bold py-2 pl-4 sm:ml-6 mb-2 text-gray-700 tracking-widest leading-tight  ">
           {{$student->plan->faculty ?? ''}}
         </li>
         </div>
         <div class="mb-6 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
           <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="firstname">
             Semester:
             </label>
           <li class=" w-2/3 font-bold py-2 pl-4 sm:ml-20 mb-2 text-gray-700 tracking-widest leading-tight  ">
            {{$student->plan->semester}}
           </li>
           </div>
           <div class="mb-6 sm:flex justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
             <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="firstname">
               Semester starting Date:
               </label>
             <li class=" w-2/3 font-bold py-2 pl-4 sm:pl-6 mb-2 text-gray-700 tracking-widest leading-tight  ">
              {{$student->plan->semester_start}}
             </li>
             </div>
             <div class="mb-6 sm:flex justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
               <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="firstname">
                 Semester Ending <br> Date :
                 </label>
               <li class=" w-2/3 font-bold font-monospace py-2 pl-4 sm:pl-6 mb-2 text-gray-700 tracking-widest leading-tight  ">
                {{$student->plan->semester_end}}
               </li>
               </div>
               <small class="text-red-500 ml-2">please ask an admin to change your graduation date if needed!</small>
               <div class="mb-6 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
                <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="firstname">
                   Graduation Date:
                   </label>
                 <li class=" w-2/3 font-bold font-monospace py-2 pl-4 sm:ml-12 mb-2 text-gray-700 tracking-widest leading-tight  ">
                  {{$student->plan->graduation_date}}
                 </li>
                 </div>
                 <div class="mb-0 sm:flex sm:justify-between sm:items-center shadow appearance-none border-b border-green-500 rounded">
                  <label class="pl-6 block text-gray-700 text-sm font-bold tracking-widest mb-2" for="firstname">
                    Money needed for Semester:
                    </label>
                  <li class=" w-2/3 font-bold font-monospace py-2 pl-4 sm:pl-6 mb-2 text-gray-700 tracking-widest leading-tight  ">
                   {{$student->plan->amount_per_semester}}
                  </li>
                  </div>
         </ul>     
   @endif
  </div>

@endsection