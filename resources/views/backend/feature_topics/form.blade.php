
                    <!--begin::Body-->
                    <div class="card-body">
                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input
                          type="text"
                          class="form-control"
                          placeholder="Enter name"
                           value="{!!old('name',@$featureTopic->name)!!}"
                          name="name" required
                        />
                
                      </div>


                      <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Content Type</label>
                        <select name="content_type_id" class="form-control" required>
                          <option value="">Select Content Type</option>
                          @foreach ($content_types as $content_type)
                            <option value="{{ $content_type->id }}" {{ (old('content_type_id', @$featureTopic->content_type_id) == $content_type->id) ? 'selected' : '' }}>{{ $content_type->name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Description</label>

                        <textarea name="short_description" class="form-control" id="short_description" rows="3">{!!old('short_description',@$featureTopic->short_description)!!}</textarea>
                      </div>

                          <div class="mb-3 ">
                              <label for="Image" class="col-md-4 col-form-label text-md-right">(360 X 220)</label>
                              <div class="col-md-6">

                              <img id="showImage" src="{{(!empty($featureTopic->image))?URL::to($featureTopic->image):URL::to('image/no_image.png')}}"  style="widows: inherit; width:120px; height:120px; border:1px solid #042b3d" alt="">
                            </div>
                          </div>
                            <div class="mb-3">
                              <label for="exampleInputFile">Image <span style="color:red" >*</span></label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" name="image" class="custom-file-input"  id="image" value="{{ @$featureTopic->image }}">
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
        