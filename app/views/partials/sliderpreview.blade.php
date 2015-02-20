<div class="row">
    @if($commit == 0)
    <div class='col-md-12'>
       <iframe class="well" style='min-height:551px !important;min-width:100%;'
               src="{{{$newHomeCmsLink}}}/fetchPreviewSlider?userid={{{$userid}}}&hash={{$hash}}">
       </iframe>
   </div>
    @else
    <div class='col-md-12'>
       <iframe class="well" style='min-height:551px !important;min-width:100%;'
               src="{{{$newHomeCmsLink}}}/commitSliderChanges?userid={{{$userid}}}&hash={{$hash}}">
       </iframe>
    </div>    
    @endif
</div> 
