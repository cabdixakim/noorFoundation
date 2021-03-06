@extends('layouts.profileMaster')

@section('content')
    
<div class="bg-gray-600 row sm:flex sm:justify-between pb-20 m-0 " >
  <div class="sm:flex  col-md-7 ">
     <div class="  sm:mt-8 sm:ml-16  p-8 flex-column ">
        <div class=" sm:mr-0 flex justify-center"><a href="{{ $fullimage ??  asset('defaultImage\default.jpg') }}"><img class="sm:h-40 sm:w-40 h-16 w-16 mb-2   object-cover rounded-full" src="{{ $avatar ??  asset('defaultImage\default.jpg') }}" alt="" /> </a></div>      
      @can('show-edit-avatar')
      <div class=" mt-2  sm:mr-0 flex justify-center"><a href="{{route('avatar.create')}}" ><i class="fa fa-camera fa-2x text-gray-400 hover:text-blue-500" aria-hidden="true"></i></a></div>
      @endcan
     
    </div>
      <div>
        <div class="md:w-64 sm:w-full rounded-lg shadow-2xl border-transparent bg-gray-700 sm:ml-4  sm:mt-20 sm:p-3   text-center text-gray-400 ">
            <div class="pt-2 pb-2 font-serif text-base  tracking wider text-gray-200">
              @if (!empty($sponsor->profile))
               <span class="uppercase"> {{($sponsor->profile->firstname.' '.$sponsor->profile->middlename.' '.$sponsor->profile->lastname) }}</span> 
                @else 
                <p>No profile to show</p>
               @endif
                  
            </div>
            
        </div>
      </div>
               
               
  </div>
   <div class="flex col-md-5  sm:my-4 mt-4 mb-4 font-sans text-gray-400 ">
    <div class="md:w-64 sm:w-full md:w-1/3 mx-2 rounded-lg shadow-lg bg-gray-700 p-2 text-center">
      <p class="mt-6">Total money Donated since joining</p>
      @if (!empty($sponsor->deposits))
      <p class="mt-20 sm:mt-16 font-bold text-gray-200 border-b border-green-400"> USD ${{number_format($sponsor->deposits->sum('amount'),0,'.',',')}} </p>
      @endif
          
    </div>
    <div class="md:w-64 sm:w-full md:w-1/3 mx-2 rounded-lg shadow-lg bg-gray-700 text-center p-2">
      <p class="mt-6">Total money Donated in the last 4 months</p>
      @if (!empty($sponsor->deposits))
        <p class="mt-32 sm:mt-16 font-bold text-gray-200 border-b border-green-400"> USD ${{number_format($sponsor->LastFourMonths(),0,'.',',')}} </p>
      @endif
          
    </div>
    
  </div>
</div>
  {{-- Tabs section --}}
  <div class="container mt-6 sm:mt-16  " id="section">
  <ul class="nav nav-tabs ml-8 sm:ml-64 ">
    <li class="active font-bold sm:text-lg "><a data-toggle="tab" class="hover:text-gray-800" href="#home">Latest deposits</a></li>
    
  </ul>

  <div class="tab-content ml-6 sm:ml-20 mt-6">
    <div id="home" class="tab-pane active ">
      @foreach ($sponsor->deposits as $deposit)
      <div class="mb-2 flex justify-start bg-gray-300 border-l border-r border-b border-t border-transparent border-gray-600 p-2  ">
        <div class="sm:flex sm:justify-between "> 
        <p><span class="text-lg font-bold font-mono">Date deposited:</span> <span class="text-gray-500 font-bold text-lg italic border-green-400">{{ \Carbon\Carbon::parse($deposit->created_at)->format('l jS \of F Y')}}</span></p> 
        <p> <span class="text-lg font-bold font-mono sm:ml-32">Amount deposited: <span class="text-sm text-gray-500">USD$</span> </span> <span class="text-red-400 border font-bold text-lg italic bg-gray-200 border-green-400">-{{number_format($deposit->amount,0,',',',')}}</span> </p> 
        </div>
        
      </div>
      @endforeach
   
      
      
    </div>

  </div>
  </div>
</div>
@endsection
