
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Quest Store Link</label>
                        <input
                          type="url"
                          class="form-control"
                          placeholder="Enter link"
                           value="{!!old('link',@$questLink->link)!!}"
                          name="link" required
                        />
                
                      </div>
     

                          <div class="mb-3 ">
                              <label for="Image" class="col-md-4 col-form-label text-md-right">(875 X 650)</label>
                              <div class="col-md-6">

                              <img id="showImage" src="{{(!empty($questLink->image))?URL::to($questLink->image):URL::to('image/no_image.png')}}"  style="widows: inherit; width:120px; height:120px; border:1px solid #042b3d" alt="">
                            </div>
                          </div>
                            <div class="mb-3">
                              <label for="exampleInputFile">Image <span style="color:red" >*</span></label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" name="image" class="custom-file-input"  id="image" value="{{ @$questLink->image }}">
                                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>

                              </div>
                            </div>



                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <!--end::Footer-->
        