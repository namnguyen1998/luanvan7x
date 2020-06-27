@include('pages.header_trangcon')
<section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">OGANI</a>
                            <span>Profile</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Thông tin hồ sơ</h4>
                            <ul>
                                <li><a href="#" class = "fa fa-user">Hồ sơ của tôi</a></li>
                                <li><a href="#" class = "fa fa-shopping-cart">Đơn mua</a></li>
                                <li><a href="#" class = "fa fa-truck">Địa chỉ</a></li>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            
                        </div>
                        <div class="sidebar__item">

                        </div>
                    </div>
                </div>
                    <div class="col-lg-9 col-md-7">
                        <div class="filter__item">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Hồ sơ của tôi</strong>
                                </div>
                                    <div class="card-body card-block" style="">
                                        <form action="{{URL::to('/capnhap')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                                @csrf
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Tên</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="text-input" name="name_customer" value="{{Session::get('name_customer')}}" class="form-control" style="width: 280px;">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Email Input</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="email-input" name="email" placeholder="Enter Email" class="form-control"style="width: 280px;">
                                                    <!-- <small class="help-block form-text">Please enter your email</small> -->
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label class=" form-control-label">Inline Radios</label>
                                                </div>
                                                <div class="col col-md-9">
                                                    <div class="form-check-inline form-check">
                                                        <label for="inline-radio1" class="form-check-label"style="padding-left: 10px;">
                                                            <input type="radio" id="inline-radio1" name="sex" value="option1" class="form-check-input">Nam
                                                        </label>
                                                        <label for="inline-radio2" class="form-check-label"style="padding-left: 10px;">
                                                            <input type="radio" id="inline-radio2" name="sex" value="option2" class="form-check-input">Nữ
                                                        </label>
                                                        <label for="inline-radio3" class="form-check-label"style="padding-left: 10px;">
                                                            <input type="radio" id="inline-radio3" name="sex" value="option3" class="form-check-input">Khác
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="file-input" class=" form-control-label">Chọn ảnh</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="file" id="file-input" name="img" class="form-control-file">
                                                </div>
                                            </div>
                                    <div class="card-footer" style="text-align: center;">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Save
                                        </button>
                                    </div>
                                </form>
                              </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
    @include('pages.footer')