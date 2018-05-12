<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Firetron Inventory System</title>

    <link href="{{ URL::asset('twb/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('twb/css/sb-admin.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('twb/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
        h1.page-header ,
        .hide
        {
            display:none;
        }
    </style>

</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Firetron Inventory Management CMS</a>
            </div>

            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
<!--                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li> -->
<!--                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li> -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
<!--                         <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li> -->
                        <li>
                            <a href="/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
<!-- 
                    @if( in_array('ADMIN', Session::get('group_user') ) )
                        <li>{!! link_to_route('components.create', 'Add Components')  !!} </li>@endif

                    @if( in_array('ADMIN', Session::get('group_user') ) )
                        <li>{!! link_to_route('products.save', 'Add Products')  !!} </li>@endif

                    @if( in_array('ADMIN', Session::get('group_user') ) )
                        <li>{!! link_to_route('mapping.create', 'Add Mapping')  !!} </li>@endif

                    @if( in_array('ADMIN', Session::get('group_user') ) )
                        <li>{!! link_to_route('agent.create', 'Add Agents')  !!} </li>@endif

                    @if( in_array('ADMIN', Session::get('group_user') ) )
                        <li>{!! link_to_route('products.mapping', 'Product Components')  !!} </li>@endif

                    @if( in_array('SALES', Session::get('group_user') ) )
                        <li>{!! link_to_route('commission.show', 'Paid Commissions')  !!} </li>@endif

                    @if( in_array('SALES', Session::get('group_user') ) )
                        <li>{!! link_to_route('commission.show', 'Paid Commissions')  !!} </li>@endif
                    
                    @if( in_array('SALES', Session::get('group_user') ) )
                        <li>{!! link_to_route('order.history', 'Order List')  !!} </li>@endif
                    @if( in_array('PURCHASING', Session::get('group_user') ) )
                        <li>{!! link_to_route('order.history', 'Order List')  !!} </li>@endif

                    @if( in_array('SALES', Session::get('group_user') ) )
                        <li>{!! link_to_route('quantity.show.stock', 'Inventory Level (Stock)')  !!} </li>@endif 
                    @if( in_array('PURCHASING', Session::get('group_user') ) )
                        <li>{!! link_to_route('quantity.show.stock', 'Inventory Level (Stock)')  !!} </li>@endif

                    @if( in_array('SALES', Session::get('group_user') ) )
                        <li>{!! link_to_route('quantity.show.raw', 'Inventory Level (Raw)')  !!} </li>@endif
                         
                    @if( in_array('PURCHASING', Session::get('group_user') ) )
                        <li>{!! link_to_route('quantity.show.raw', 'Inventory Level (Raw)')  !!} </li>@endif
                        

                    @if( in_array('SALES', Session::get('group_user') ) )
                        <li>{!! link_to_route('commission.pending', 'Pending Commissions')  !!} </li>@endif -->
                    
                    @if( in_array('ADMIN', Session::get('group_user') ) )
                        <li>{!! link_to_route('gui.full', 'Link to Conso GUI')  !!} </li>@endif

                    @if( in_array('ADMIN', Session::get('group_user') ) )
                        <li>{!! link_to_route('products.show-build', 'Build Products')  !!} </li>@endif

                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper" style="min-height: 800px">

            <div class="container-fluid">
                <div class="row">
                    @yield('header')
                </div>

                <div cl dd(ass="row">   
                    @yield('content')
                </div>
            </div>

        </div>

    </div>

    <!-- jQuery -->
    <script src="{{ URL::asset('twb/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ URL::asset('twb/js/bootstrap.min.js')}}"></script>

    <!-- DataTables JS -->
    <script src="{{ URL::asset('twb/data-table/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('twb/data-table/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        // customer
        $("#products_build_quantity").on('change paste keyup', function()
        {
            $(".products_build_quantity_final").val($("#products_build_quantity").val());
            console.log($("#products_build_quantity").val());
        });


        /*
         | ----------------------------------------------------------------
         | Datatables
         | ----------------------------------------------------------------
         |
         | 
         |
         */
        $('#data_table').DataTable();

        $('#data_table_inventory_cancellation').Datatable({"order": [[ 4, "desc" ]]});
        $('#data_table_order_history').Datatable({"order": [[ 3, "desc" ]]});
        $('#data_table_inventory_level').Datatable({"order": [[ 6, "desc" ]]});
        $('#data_table_commission').Datatable({"order": [[ 0, "desc" ]]});

        // cancellation 4
        // order history 3
        // inventory level 6
        // commission 0
    </script>

</body>
</html>
