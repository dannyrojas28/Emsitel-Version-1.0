<div id="container">
    <div id="row">
        <div id="col-xs-offset-1 col-xs-11">
        <h3>**Esta sesiòn requiere autenticacion**</h3>
            <div class="col-sm-6 col-xs-12">
            
            <form method="post">
                
                <div class="form-group">
                    <label id="examplePass" class="col-xs-12">Contraseña</label>
                    <div class="col-xs-6 ">
                        
                    <input type="password" class="form-control " placeholder="Digite la contraseña" id="password">
                    </div>
                    <div class="col-xs-7">
                        <span id="error_pass"  class="error_log"></span>
                    <span id="excelente"  class="buena"></span><br>
                    <button type="button" onclick="Password()" class="btn btn-primary"><span class="glyphicon glyphicon-circle-arrow-right"></span>  Ingresar</button>
                    <button type="button" onclick="LimpiarPass()" class="btn btn-success"><span class="glyphicon glyphicon-trash"></span>   Limpiar</button>
                    </div>
                  
                    
                </div>
            </form>
            </div>
            
            
        </div>
        
    </div>
    
</div>