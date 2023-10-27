<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block !important;
        }
    </style>
    <div class="section-title-01 honmob">
        <div class="bg_parallax image_02_parallax"></div>
        <div class="opacy_bg_02">
            <div class="container">
                <h1>Service Providers</h1>
                <div class="crumbs">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>/</li>
                        <li>Service Providers</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="content-central">
        <div class="content_info">
            <div class="paddings-mini">
                <div class="container">
                    <div class="row portfolioContainer">
                        <div class="col-md-12 profile1">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-6">
                                            All Service Providers
                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>City</th>
                                                <th>Service Category</th>
                                                <th>Service Locations</th>
                                                <th style="pull-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($serviceProviders as $serviceProvider)
                                                <tr class="">
                                                    <td>{{ $serviceProvider->id }}</td>
                                                    <td><img src="{{ asset('images/service-provider') }}/{{ $serviceProvider->image }}"
                                                            width="60" height="25"></td>
                                                    <td>{{ $serviceProvider->user->name }}</td>
                                                    <td>{{ $serviceProvider->user->email }}</td>
                                                    <td>{{ $serviceProvider->user->phone }}</td>
                                                    <td>{{ $serviceProvider->city }}</td>
                                                    <td>{{ $serviceProvider->category->name }}</td>
                                                    <td>{{ $serviceProvider->service_location }}</td>

                                                    <td style="float: right">
                                                        <a href="#" style="margin-right: 10px"><i
                                                                class="fa fa-list fa-2x"></i></a>
                                                        <a href="#"><i class="fa fa-edit fa-2x"></i></a>
                                                        <a href="#"

                                                            style="margin-left: 10px"><i
                                                                class="fa fa-times fa-2x text-danger"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $serviceProviders->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
