    <div id="search_form_menna">
        <div class="clearfix row">
            <!--name-->
            <div class="col-md-4 col-sm-12 form_label">
                <div class="form-group">
                    <label for="basic-url">
                        {{ trans('Dashboard.Name')}}
                    </label>
                    <div class="mb-3 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-pencil"></i>
                            </span>
                        </div>
                        <input type="text"
                                class="form-control"
                                id="name"
                                placeholder="{{ trans('Dashboard.Name')}}"
                                name="name"
                                autocomplete="off"
                                spellcheck="true"
                                aria-label="name"
                                aria-describedby="basic-addon1"
                        >
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5"></div>
            <div class="col-md-2">
                <div class="mb-12 input-group">
                    <button name="Search" class="btn btn-outline-info" id="search_btn"><i class="fa-solid fa-magnifying-glass"></i> {{ trans('Dashboard.Search')}} </button>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>
    </div>



