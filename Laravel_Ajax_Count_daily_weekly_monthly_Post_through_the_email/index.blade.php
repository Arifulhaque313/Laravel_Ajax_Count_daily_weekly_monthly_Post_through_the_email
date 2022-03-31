
@extends('layouts.main')

@section('content')
   


    <!-- BEGIN: General Report -->
    <div class="col-span-12 mt-8">
        <div class=" flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">
               DashBoard
            </h2>
            <a href="" class="ml-auto flex items-center text-theme-30 dark:text-theme-25"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
        </div>  


        {{-- Search  form   --}}
        <div class=" mt-8">
                <form action="" id="searchForm" method="GET">
                        @csrf
                        <div class="inline-block mr-3" style="width: 49%">
                            <input type="text" name="email" id="email" class="form-control py-2"   placeholder="Search  Email" >
                        </div>
                        
                        <div class="inline-block">
                            <input type="submit" id="searchBtn"  value="Search" class="btn  btn-primary px-8 ml-3"></input> 
                        </div>
                </form>  
        </div>

        

        {{-- count value   --}}
        <div  class="c">

            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 ">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="shopping-cart" class="report-box__icon text-theme-24 dark:text-theme-25"></i> 
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-20 tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-medium leading-8 mt-6" > <h1 id="daily_count"></h1> </div>
                            <div class="text-base text-gray-600 mt-1">Daily  Post</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 ">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="credit-card" class="report-box__icon text-theme-29"></i> 
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-21 tooltip cursor-pointer" title="2% Lower than last month"> 2% <i data-feather="chevron-down" class="w-4 h-4 ml-0.5"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-medium leading-8 mt-6"><h1 id="weekly_count"></h1></div>
                            <div class="text-base text-gray-600 mt-1">Weekly Post  Post</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 ">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="monitor" class="report-box__icon text-theme-15"></i> 
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-20 tooltip cursor-pointer" title="12% Higher than last month"> 12% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-medium leading-8 mt-6"><h1 id="monthly_count"></h1></div>
                            <div class="text-base text-gray-600 mt-1">Monthly  Post</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 ">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="user" class="report-box__icon text-theme-20"></i> 
                                <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-20 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                </div>
                            </div>
                            <div class="text-3xl font-medium leading-8 mt-6"><h1 id="yearly_count"></h1></div>
                            <div class="text-base text-gray-600 mt-1">Yearly</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
    <!-- END: General Report -->



    
    
     
    
    <!-- BEGIN: HTML Table Data -->
   <div class="dt">
    <h2 class="text-lg font-medium truncate mr-5 mt-20 " >
        Data Table
     </h2>
     <div class="box p-5 mt-8">
        <div class="overflow-x-auto scrollbar-hidden">
            <div class="mt-5 table-report table-report--tabulator">
                <table id="" class='display dataTable'>
                    <thead>
                        

                        {{-- @foreach ($post as $p)
                            
                            <tr>
                                <td><center>{{ $p->id }}</center></td>
                                <td><center>{{ $p->title }}</center></td>
                                <td><center>{{ $p->published }}</center></td>
                                <td><center>{{ $p->created_at }}</center></td>
                            </tr>
                             

                        @endforeach --}}
                       
                    </thead>
                    <tbody>
                        <div id="search_list"  class="search-data" style="background-color:rgb(82, 196, 110);color:white; border-radius:5px ;margin-top:10px; padding:10px 10px">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   </div>
    <!-- END: HTML Table Data -->
  



    <style>
        .c{
            display: none;
        }
        .dt{
            display: none;
        }
    </style>


@endsection


@section('script')

   <script>

        $(document).ready(function(){
                $('#searchForm').on('submit',function(e){
                    e.preventDefault();
                    let searchEmail = $('#email').val();

                    if(searchEmail){
                        $('.c').show();
                        $('.dt').show();

                    }
                    

                    
                    $.ajax({
                    url:"{{ route('email.search') }}",
                    type:"GET",
                    dataType: 'json',
                    data:{'email':searchEmail},
                    
                    success:function(data){
                        // console.log(data.daily_count);
                        // console.log(data.weekly_count);
                        // console.log(data.monthly_count);
                        $('#search_list').html(data.details);
                        $('#daily_count').html(data.daily_count);
                        $('#weekly_count').html(data.weekly_count);
                        $('#monthly_count').html(data.monthly_count);
                        $('#yearly_count').html(data.yearly_count);
                    }

                    });
                    
                });
        });
   </script>

@endsection