<div class="row" style="margin-top: 20px;">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua">7</span>
        <div class="info-box-content">
          <span class="info-box-text">{{ $firstBoxText }}</span>
          <span class="info-box-number" style="font-size: 30px;">{{ $last7DaysCount }}</span>
        </div> 
      </div> 
    </div> 
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red">30</span>
        <div class="info-box-content">
          <span class="info-box-text">{{ $secondBoxText }}</span>
          <span class="info-box-number" style="font-size: 30px;">{{ $last30DaysCount }}</span>
        </div> 
      </div> 
    </div> 
    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green">365</span>
        <div class="info-box-content">
          <span class="info-box-text">{{ $thirdBoxText }}</span>
          <span class="info-box-number" style="font-size: 30px;">{{ $last365DaysCount }}</span>
        </div> 
      </div> 
    </div> 
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow">All</span>
        <div class="info-box-content">
          <span class="info-box-text">{{ $fourthBoxText }}</span>
          <span class="info-box-number" style="font-size: 30px;">{{ $allCount }}</span>
        </div> 
      </div> 
    </div> 
</div>