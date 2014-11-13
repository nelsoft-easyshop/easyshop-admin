<div class="row">
    @if($commit == 0)
    <div class='col-md-12'>
       <iframe class="well" style='min-height:460px !important;min-width:100%;'
               src="{{{$newHomeCmsLink}}}/fetchPreviewSlider?userid={{{$userid}}}&password={{$password}}&hash={{$hash}}">
       </iframe>
   </div>
    @else
    <div class='col-md-12'>
       <iframe class="well" style='min-height:460px !important;min-width:100%;'
               src="{{{$newHomeCmsLink}}}/commitSliderChanges">
       </iframe>
    </div>    
    @endif
</div> 
