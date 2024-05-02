@include('layout.start')


@include('layout.a_navbar')


<!-- strat wrapper -->
<div class="h-screen flex flex-row flex-wrap">
  
  @include('layout.a_sidebar')

  <!-- strat content -->
  <div class="bg-gray-100 flex-1 p-6 md:mt-16">
    
    @include('template.ui.alert.head')
    @include('template.ui.alert.alert_1')
    @include('template.ui.alert.alert_2')
    @include('template.ui.alert.alert_3')

  </div>
  <!-- end content -->

</div>
<!-- end wrapper --> 

  

@include('layout.end')