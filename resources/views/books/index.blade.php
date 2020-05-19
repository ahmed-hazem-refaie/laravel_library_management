@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Book Title </div>

                <div class="card-body">
                    <div style="float:right;"> <i class="fa fa-heart-o" style="font-size: 25px;"></i> </div>
                    <div class="card mb-3" style="max-width: 540px; border: none;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="..." class="card-img" alt="...">
                            </div>

                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Comment Section -->
                    <div>
                        <form>
                            <div class="form-row">
                                <div class="col-md-8">
                                    <textarea type="text" row="16" class="form-control" placeholder="Place Your Comment Here"></textarea>
                                    <button class="btn btn-success mt-3"> Add Comment</button>
                                </div>
                                <div class="col-md-3 ml-5 mt-3">
                                @for ($i = 0; $i < 6; $i++)
                                    <i class="fa fa-star-o" style="font-size: 20px;"></i>
                                @endfor
                                </div>
                            </div>
                        </form>
                    </div>


                    <!-- List All Comments Section -->
                    <div class="mt-5">
                        <div class="list-group">
                            <span class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">List group item heading</h5>
                                <small>3 days ago</small>
                                </div>
                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                <small>Donec id elit non mi porta.</small>
                           </span>
                            <span class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">List group item heading</h5>
                                <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                <small class="text-muted">Donec id elit non mi porta.</small>
                           </span>
                            <span class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">List group item heading</h5>
                                <small class="text-muted">3 days ago</small>
                                </div>
                                <p class="mb-1">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                <small class="text-muted">Donec id elit non mi porta.</small>
                           </span>
                        </div>
                    </div>


                    <!-- Related Books Slider -->
                    <div class="mt-5">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="..." class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="..." class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                <img src="..." class="d-block w-100" alt="...">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                    {{$books}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
