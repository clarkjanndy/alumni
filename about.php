 <!-- Masthead-->
        <header class="masthead" style="height:100vh;">
            <div class="container h-50">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: transparent;">
                    	 <h1 class="text-uppercase text-white font-weight-bold">About Us</h1>
                    </div>
                    
                </div>
            </div>
        </header>

    <section class="">
        <div class="container-fluid bg-theme p-5">
        <?php echo html_entity_decode($_SESSION['system']['about_content']) ?>        
            
        </div>
        </section>