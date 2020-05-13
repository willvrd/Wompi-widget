<div class="wompi-widget">

	<div class="panel-group">
	  <div class="panel panel-primary">

	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" href="#collapseWidget">
	        	<i class="fa fa-credit-card icon-title" aria-hidden="true"></i>
	        	PAGAR CON WOMPI
	        </a>
	      </h4>
	    </div>

	    <div id="collapseWidget" class="panel-collapse collapse">
	      <div class="panel-body">

	      	<a class="logo-wompi" title="Una solucion de Bancolombia">
          		<img alt="Wompi" width="145" src="https://wompi.co/wp-content/themes/wp-theme-wompi/dist/images/wompi-blanco_a24785f1.svg">
        	</a>

	      	<div class="input-group input-group-sm mb-3">
	      		<label>Ingrese el monto:</label>
		        <input type="number" min="1500" value="1500" class="form-control" id="amountInCents" placeholder="Monto" aria-label="Recipient's username" aria-describedby="button-addon2" >
		        <div class="input-group-append">
		            <button class="btn btn-primary btn-sm" type="submit" onclick="wompiPay();" id="button-addon2">
		            PAGAR
		            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
		        	</button>
		        </div>
		    </div>

	      </div>
	      
	    </div>

	  </div>
	</div>

</div>


<style type="text/css">
	.home{
		position: relative;
	}
	.wompi-widget{
		position: fixed;
	 	z-index: 9999;
	 	right: 0;
	 	top: 28%;
	}
	.wompi-widget .btn{
		margin-top: 10px;
	}
	.logo-wompi{
		display: block;
		background-color: #00448d;
		margin-bottom: 10px;
		text-align: center;
	}
	.wompi-widget .panel-title i{
		margin-right: 3px;
	}
	.wompi-widget .input-group label{
		display: block;
	}
</style>


@section('scripts')
    @parent

    <script type="text/javascript" src="https://checkout.wompi.co/widget.js"></script>

    <script type="text/javascript">

    	
    	var publicKey = 'pub_test_Q5yDA9xoKdePzhSGeVe9HAez7HgGORGf'
    	var currency = 'COP'
    	var minAmount = 1500
    	
    	/** Create the Reference  */
    	function makeReference(){
    		var d = new Date();
    		var reference = "LAZA-"+d.getTime()
    		return reference;
    	}

    	/** Init WompiPay */
    	function wompiPay() {

    	 	console.warn("*** WIDGET WOMPI - Init")

    	 	var reference = makeReference()
            var amount = document.getElementById('amountInCents').value
            var amountCent = amount * 100;
           
            try {
			    
			    var checkout = new WidgetCheckout({
			        currency: currency,
			        amountInCents: amountCent,
			        reference: reference,
			        publicKey: publicKey
			    });

			    // Response
			    checkout.open(function ( result ) {
	                var transaction = result.transaction
	                if(transaction.status=="APPROVED"){
	                	$("#collapseWidget").collapse('hide');
	                	document.getElementById('amountInCents').value = minAmount
	                }
	            });

			}catch(err) {
			    alert(err)
			}

        }

    </script>

@stop