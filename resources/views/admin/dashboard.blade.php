@extends('admin.layouts.master')

@section('title', isset($pageTitle) ? $pageTitle : 'Page Title Here')

@section('content')

<div class="main-content-wrap">
    <div class="tf-section-2 mb-30">
        <div class="flex gap20 flex-wrap-mobile">
            <div class="w-half">

                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Total Customers</div>
                                <h4></h4>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Total Invoice</div>
                                <h4></h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-dollar-sign"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Total Revenue</div>
                                <h4></h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wg-chart-default">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-dollar-sign"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Weekly Revenue</div>
                                <h4></h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="w-half">

                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Monthly Revenue</div>
                                <h4></h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-dollar-sign"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Yearly Revenue</div>
                                <h4></h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wg-chart-default mb-20">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Paid Invoice</div>
                                <h4></h4>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="wg-chart-default">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap14">
                            <div class="image ic-bg">
                                <i class="icon-shopping-bag"></i>
                            </div>
                            <div>
                                <div class="body-text mb-2">Pending Invoice</div>
                                <h4></h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between">
                <h5>Earnings revenue</h5>
                <div class="dropdown default">
                    <button class="btn btn-secondary dropdown-toggle" type="button"
                        data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        {{-- <span class="icon-more"><i class="icon-more-horizontal"></i></span> --}}
                    </button>
                    {{-- <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="javascript:void(0);">This Week</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">Last Week</a>
                        </li>
                    </ul> --}}
                </div>
            </div>
            <div class="flex flex-wrap gap40">
                <div>
                    <div class="mb-2">
                        <div class="block-legend">
                            <div class="dot t1"></div>
                            <div class="text-tiny">Revenue</div>
                        </div>
                    </div>
                    <div class="flex items-center gap10">
                        <h4>$ </h4>
                        <div class="box-icon-trending up">
                            {{-- <i class="icon-trending-up"></i>
                            <div class="body-title number">0.56%</div> --}}
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mb-2">
                        <div class="block-legend">
                            <div class="dot t2"></div>
                            <div class="text-tiny">Invoices</div>
                        </div>
                    </div>
                    <div class="flex items-center gap10">
                        <h4>$ </h4>
                        <div class="box-icon-trending up">
                            {{-- <i class="icon-trending-up"></i>
                            <div class="body-title number">0.56%</div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div id="line-chart-8"></div>
        </div>

    </div>
    <div class="tf-section mb-30">

        <div class="wg-box">
            <div class="flex items-center justify-between">
                <h5>Recent Invoices</h5>
                <div class="dropdown default">
                    <a class="btn btn-secondary dropdown-toggle" href="#">
                        {{-- <span class="view-all">View all</span> --}}
                    </a>
                </div>
            </div>
            <div class="wg-table table-all-user">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 80px">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Invoice No</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Discount</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Invoice Date</th>
                                <th class="text-center">Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($users as $key => $invoice) --}}
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>
                                    <td class="text-center"></td>

                                    {{-- Calculate total discount from invoice_details --}}

                                    <td class="text-center"></td>

                                    <td class="text-center"></td>
                                    <td class="text-center"></td>

                                    {{-- Calculate total amount from invoice_details --}}

                                    <td class="text-center"></td>

                                    <td class="text-center">
                                        <a href="">
                                            <div class="list-icon-function view-icon">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

@push('scripts')


    @endpush
