<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="headerfooter">
            <h3 class="section-title">Total de Buses en cada proceso o estado</h3>
            <p>El proceso de lavado se puede actualizar unicamente para los buses que se encuentren en SOC_OUT.</p>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-header alert-warning  bg-warning">
                <b>SOC_IN&nbsp;&nbsp;&nbsp;</b>
                <i class="m-r-10 mdi mdi-battery-charging-20"></i>
            </div>
            <div class="card-body alert-warning">
                <p class="card-text">Último prceso registrado SOC In</p>
                <h2 class="alert-warning" id="unIn"><span class="dashboard-spinner spinner-xs"></span></h2>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-header alert-success  bg-success">
                <b>SOC_OUT&nbsp;&nbsp;&nbsp;</b>
                <i class="m-r-10 mdi mdi-battery-charging-100"></i>
            </div>
            <div class="card-body alert-success">
                <p class="card-text">Último prceso registrado SOC Out</p>
                <h2 class="alert-success" id="unOut"><span class="dashboard-spinner spinner-xs"></span></h2>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <b>LAVADO SI&nbsp;&nbsp;&nbsp;</b>
                <i class="m-r-10 mdi mdi-creation"></i>                
            </div>
            <div class="card-body alert-primary">
                <p class="card-text">Lavados en último registro SOC Out</p>
                <h2 class="alert-primary" id="unLavSi"><span class="dashboard-spinner spinner-xs"></span></h2>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-header alert-danger  bg-secondary">
                <b>NO LAVADO&nbsp;&nbsp;&nbsp;</b>
                <i class="m-r-10 mdi mdi-cup-off"></i>
            </div>
            <div class="card-body alert-danger">
                <p class="card-text">NO lavados en último registro SOC Out</p>
                <h2 class="alert-danger" id="unLavNo"><span class="dashboard-spinner spinner-xs"></span></h2>
            </div>
        </div>
    </div>
    <span><i class="m-r-10 mdi mdi-bus" style="color: #deaa00; font-size: xx-large"></i>SOC In&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <span><i class="m-r-10 mdi mdi-bus" style="color: #2ec551; font-size: xx-large"></i>SOC Out&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <span><i class="m-r-10 mdi mdi-cup-water" style="color: #5969ff; font-size: xx-large"></i>Lavado&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <span><i class="m-r-10 mdi mdi-cup-off" style="color: #ff407b; font-size: xx-large"></i>No lavado&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="SectionTableAllBus">
        
    </div>    
</div>