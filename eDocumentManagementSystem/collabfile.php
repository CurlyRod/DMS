<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
								
								</div>
								<div class="card-body">  
                                            <div class="container"> 

                                            <?php $input =  isset($_GET['fid']) ? $_GET['fid'] :'';

                                            if (empty($input )) {
                                                ?> <input type="hidden" id="filesid" name="filesid"  
                                                value="-1"><?php
                                             
                                            } else {
                                         ?> <input type="hidden" id="filesid" name="filesid"  
                                                value="<?php 
                                                       if(isset($_GET['fid'])) 
                                                       { 
                                                          echo $_GET['fid'];
                                                       }
                                                       ?> "><?php
                                            } 
                                                ?>
                                           
                                         
                                            <div class="drop-section"> 
                                        <div class="col">
                                            <div class="cloud-icon">  
                                            
                                                <img src="./cloud.gif" alt="" style="height:100px;">
                                            </div> 
                                            <span> Drag & Drop your files Here!</span> 
                                            <span>OR</span> 
                                            <button class="btn btn-primary file-selector">Browse files</button>  
                                            <input type="file" name="files" id="files" class="file-selector-input" multiple >
                                        </div>
                                        <div class="col"> 
                                                <div class="drop-here"> 
                                                DROP HERE
                                                </div>
                                        </div>
                                    </div>  
                                         
                                    <div class="list-section"> 
                                        <div class="list-title text-uppercase"> Uploaded Files    
                                        <div class="remove-all d-flex justify-content-end"> 
                                        <button class="btn btn-sm btn-danger" id="remove" >Remove all</button>
                                       
                                        </div>
                                        <div class="list"> 
                                                <!-- <li class="in-prog"> 
                                                    
                                                </li> -->
                                            </div> 
                                           
                                        </div>
                                    </div>
                                            </div>
                                        
                                        </div>
                                       


                                    </div> 
                        
						</div>
					</div>
                    <script src="./src/js/filesave.js" type="text/javascript"></script>
                                            <script> 
                                      //  console.log(formatBytes(2147483648));
                                        </script>
                 