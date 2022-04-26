@extends('layouts.app')
@section('head')
    @include('layouts.partials.headersection',['title'=>trans('Customers')])
@endsection
@section('content')
    <div class="row">
        <div class="col-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <a href="{{ route('admin.customer.index') }}"
                               class="mr-2 btn btn-outline-primary @if($type==="all") active @endif">{{ __('All') }}
                                ({{ $all }})</a>

                            <a href="{{ route('admin.customer.index','type=1') }}"
                               class="mr-2 btn btn-outline-success @if($type==1) active @endif">{{ __('Active') }}
                                ({{ $actives }})</a>

                            <a href="{{ route('admin.customer.index','type=2') }}"
                               class="mr-2 btn btn-outline-warning @if($type==2) active @endif">{{ __('Suspened') }}
                                ({{ $suspened }})</a>

                            <a href="{{ route('admin.customer.index','type=3') }}"
                               class="mr-2 btn btn-outline-warning @if($type==3) active @endif">{{ __('Pending') }}
                                ({{ $pendings }})</a>


                            <a href="{{ route('admin.customer.index','type=trash') }}"
                               class="mr-2 btn btn-outline-danger @if($type === 0) active @endif">{{ __('Trash') }}
                                ({{ $trash }})</a>
                        </div>

                        <div class="col-sm-4 text-right">
                            @can('customer.create')
                                <a href="{{ route('admin.customer.create') }}"
                                   class="btn btn-primary">{{ __('Create Customer') }}</a>
                            @endcan
                        </div>
                    </div>

                    <!--div class="float-right">
                        <form>
                            <input type="hidden" name="type" value="@if($type === 0) trash @else {{ $type }} @endif">
                            <div class="input-group mb-2">

                                <input type="text" id="src" class="form-control" placeholder="{{__('Search...')}}"
                                       required="" name="src" autocomplete="off" value="{{ $request->src ?? '' }}">
                                <select class="form-control selectric" name="term" id="term">
                                    <option value="domain">{{ __('Search By Domain Name') }}</option>
                                    <option value="id">{{ __('Search By Customer Id') }}</option>
                                    <option value="email">{{ __('Search By User Mail') }}</option>

                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div -->

                    <form method="post" action="{{ route('admin.customers.destroys') }}" class="basicform_with_reload">
                        @csrf
                        <div class="float-left mb-1">
                            @can('customer.delete')
                                <div class="input-group">
                                    <select class="form-control selectric" name="method">
                                        <option value="">{{ __('Select Action') }}</option>
                                        <option value="1">{{ __('Publish') }}</option>
                                        <option value="2">{{ __('Suspend') }}</option>
                                        <option value="3">{{ __('Move To Pending') }}</option>
                                        @if($type !== "trash")
                                            <option value="trash">{{ __('Move To Trash') }}</option>
                                        @endif
                                        @if($type=="trash")
                                            <option value="delete">{{ __('Delete Permanently') }}</option>
                                        @endif
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary basicbtn"
                                                type="submit">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            @endcan
                        </div>


                        <div class="table-responsive">
                            <table  id="example" class="table table-striped table-hover text-center table-borderless">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" class="checkAll"></th>

                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('type') }}</th>
                                    <th>{{ __('Domain') }}</th>
                                    <th>{{ __('Storage Used') }}</th>
                                    <th>{{ __('Plan') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Join at') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $row)
                                    <tr id="row{{ $row->id }}">
                                        <td><input type="checkbox" name="ids[]" value="{{ $row->id }}"></td>
                                        <td>{{ $row->name }}</td>
                                        <td><a href="mailto:{{ $row->email }}">{{ $row->email }}</a></td>
                                        <td>
                                            @if($row->shop_type == 1)
                                                <b class="badge badge-info">{{ __('Online Shop') }}</b>
                                            @elseif($row->shop_type == 2)
                                                <b class="badge badge-danger">{{ __('Supermarkets / Pharmacies') }}</b>
                                            @elseif($row->shop_type == 3)
                                                <b class="badge badge-warning">{{ __('Restaurant') }}</b>
                                            @else
                                                <b class="badge badge-success">{{ __('Beauty Center') }}</b>
                                            @endif
                                        </td>
                                        <td><a href="{{ $row->user_domain->full_domain ?? '' }}"
                                               target="_blank">{{ $row->user_domain->domain ?? '' }}</a></td>
                                        <td>{{ folderSize('uploads/'.$row->id) }}MB
                                            / {{ $row->user_plan->plan_info->storage ?? 0 }} MB
                                        </td>
                                        <td>{{ $row->user_plan->plan_info->name ?? '' }}</td>
                                        <td>
                                            @if($row->status==1) <span
                                                class="badge badge-success">{{ __('Active') }}</span>
                                            @elseif($row->status==0) <span
                                                class="badge badge-danger">{{ __('Trash') }}</span>
                                            @elseif($row->status==2) <span
                                                class="badge badge-warning">{{ __('Suspended') }}</span>
                                            @elseif($row->status==3) <span
                                                class="badge badge-warning">{{ __('Pending') }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->created_at->format('d-F-Y')  }}</td>
                                        <td>
                                            <div class="dropdown d-inline">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton2" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    {{ __('Action') }}
                                                </button>
                                                <div class="dropdown-menu">

                                                    @can('customer.edit')
                                                        <a class="dropdown-item has-icon"
                                                           href="{{ route('admin.customer.edit',$row->id) }}"><i
                                                                class="far fa-edit"></i> {{ __('Edit') }}</a>
                                                    @endcan
                                                    @can('customer.view')
                                                        <a class="dropdown-item has-icon"
                                                           href="{{ route('admin.customer.show',$row->id) }}"><i
                                                                class="far fa-eye"></i>{{ __('View') }}</a>
                                                    @endcan

                                                    <a class="dropdown-item has-icon"
                                                       href="{{ route('admin.order.create','email='.$row->email) }}"><i
                                                            class="fas fa-cart-arrow-down"></i>{{ __('Make Order') }}
                                                    </a>

                                                    <a class="dropdown-item has-icon"
                                                       href="{{ route('admin.customer.show',$row->id) }}"><i
                                                            class="far fa-envelope"></i>{{ __('Send Email') }}</a>
                                                </div>
                                            </div>


                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th><input type="checkbox" class="checkAll"></th>

                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('type') }}</th>
                                    <th>{{ __('Domain') }}</th>
                                    <th>{{ __('Storage Used') }}</th>
                                    <th>{{ __('Plan') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Join at') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </tfoot>
                            </table>


                            <!--table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012/03/29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008/11/28</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012/12/02</td>
                <td>$372,000</td>
            </tr>
            <tr>
                <td>Herrod Chandler</td>
                <td>Sales Assistant</td>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012/08/06</td>
                <td>$137,500</td>
            </tr>
            <tr>
                <td>Rhona Davidson</td>
                <td>Integration Specialist</td>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010/10/14</td>
                <td>$327,900</td>
            </tr>
            <tr>
                <td>Colleen Hurst</td>
                <td>Javascript Developer</td>
                <td>San Francisco</td>
                <td>39</td>
                <td>2009/09/15</td>
                <td>$205,500</td>
            </tr>
            <tr>
                <td>Sonya Frost</td>
                <td>Software Engineer</td>
                <td>Edinburgh</td>
                <td>23</td>
                <td>2008/12/13</td>
                <td>$103,600</td>
            </tr>
            <tr>
                <td>Jena Gaines</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>30</td>
                <td>2008/12/19</td>
                <td>$90,560</td>
            </tr>
            <tr>
                <td>Quinn Flynn</td>
                <td>Support Lead</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2013/03/03</td>
                <td>$342,000</td>
            </tr>
            <tr>
                <td>Charde Marshall</td>
                <td>Regional Director</td>
                <td>San Francisco</td>
                <td>36</td>
                <td>2008/10/16</td>
                <td>$470,600</td>
            </tr>
            <tr>
                <td>Haley Kennedy</td>
                <td>Senior Marketing Designer</td>
                <td>London</td>
                <td>43</td>
                <td>2012/12/18</td>
                <td>$313,500</td>
            </tr>
            <tr>
                <td>Tatyana Fitzpatrick</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>19</td>
                <td>2010/03/17</td>
                <td>$385,750</td>
            </tr>
            <tr>
                <td>Michael Silva</td>
                <td>Marketing Designer</td>
                <td>London</td>
                <td>66</td>
                <td>2012/11/27</td>
                <td>$198,500</td>
            </tr>
            <tr>
                <td>Paul Byrd</td>
                <td>Chief Financial Officer (CFO)</td>
                <td>New York</td>
                <td>64</td>
                <td>2010/06/09</td>
                <td>$725,000</td>
            </tr>
            <tr>
                <td>Gloria Little</td>
                <td>Systems Administrator</td>
                <td>New York</td>
                <td>59</td>
                <td>2009/04/10</td>
                <td>$237,500</td>
            </tr>
            <tr>
                <td>Bradley Greer</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>41</td>
                <td>2012/10/13</td>
                <td>$132,000</td>
            </tr>
            <tr>
                <td>Dai Rios</td>
                <td>Personnel Lead</td>
                <td>Edinburgh</td>
                <td>35</td>
                <td>2012/09/26</td>
                <td>$217,500</td>
            </tr>
            <tr>
                <td>Jenette Caldwell</td>
                <td>Development Lead</td>
                <td>New York</td>
                <td>30</td>
                <td>2011/09/03</td>
                <td>$345,000</td>
            </tr>
            <tr>
                <td>Yuri Berry</td>
                <td>Chief Marketing Officer (CMO)</td>
                <td>New York</td>
                <td>40</td>
                <td>2009/06/25</td>
                <td>$675,000</td>
            </tr>
            <tr>
                <td>Caesar Vance</td>
                <td>Pre-Sales Support</td>
                <td>New York</td>
                <td>21</td>
                <td>2011/12/12</td>
                <td>$106,450</td>
            </tr>
            <tr>
                <td>Doris Wilder</td>
                <td>Sales Assistant</td>
                <td>Sydney</td>
                <td>23</td>
                <td>2010/09/20</td>
                <td>$85,600</td>
            </tr>
            <tr>
                <td>Angelica Ramos</td>
                <td>Chief Executive Officer (CEO)</td>
                <td>London</td>
                <td>47</td>
                <td>2009/10/09</td>
                <td>$1,200,000</td>
            </tr>
            <tr>
                <td>Gavin Joyce</td>
                <td>Developer</td>
                <td>Edinburgh</td>
                <td>42</td>
                <td>2010/12/22</td>
                <td>$92,575</td>
            </tr>
            <tr>
                <td>Jennifer Chang</td>
                <td>Regional Director</td>
                <td>Singapore</td>
                <td>28</td>
                <td>2010/11/14</td>
                <td>$357,650</td>
            </tr>
            <tr>
                <td>Brenden Wagner</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>28</td>
                <td>2011/06/07</td>
                <td>$206,850</td>
            </tr>
            <tr>
                <td>Fiona Green</td>
                <td>Chief Operating Officer (COO)</td>
                <td>San Francisco</td>
                <td>48</td>
                <td>2010/03/11</td>
                <td>$850,000</td>
            </tr>
            <tr>
                <td>Shou Itou</td>
                <td>Regional Marketing</td>
                <td>Tokyo</td>
                <td>20</td>
                <td>2011/08/14</td>
                <td>$163,000</td>
            </tr>
            <tr>
                <td>Michelle House</td>
                <td>Integration Specialist</td>
                <td>Sydney</td>
                <td>37</td>
                <td>2011/06/02</td>
                <td>$95,400</td>
            </tr>
            <tr>
                <td>Suki Burks</td>
                <td>Developer</td>
                <td>London</td>
                <td>53</td>
                <td>2009/10/22</td>
                <td>$114,500</td>
            </tr>
            <tr>
                <td>Prescott Bartlett</td>
                <td>Technical Author</td>
                <td>London</td>
                <td>27</td>
                <td>2011/05/07</td>
                <td>$145,000</td>
            </tr>
            <tr>
                <td>Gavin Cortez</td>
                <td>Team Leader</td>
                <td>San Francisco</td>
                <td>22</td>
                <td>2008/10/26</td>
                <td>$235,500</td>
            </tr>
            <tr>
                <td>Martena Mccray</td>
                <td>Post-Sales support</td>
                <td>Edinburgh</td>
                <td>46</td>
                <td>2011/03/09</td>
                <td>$324,050</td>
            </tr>
            <tr>
                <td>Unity Butler</td>
                <td>Marketing Designer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/12/09</td>
                <td>$85,675</td>
            </tr>
            <tr>
                <td>Howard Hatfield</td>
                <td>Office Manager</td>
                <td>San Francisco</td>
                <td>51</td>
                <td>2008/12/16</td>
                <td>$164,500</td>
            </tr>
            <tr>
                <td>Hope Fuentes</td>
                <td>Secretary</td>
                <td>San Francisco</td>
                <td>41</td>
                <td>2010/02/12</td>
                <td>$109,850</td>
            </tr>
            <tr>
                <td>Vivian Harrell</td>
                <td>Financial Controller</td>
                <td>San Francisco</td>
                <td>62</td>
                <td>2009/02/14</td>
                <td>$452,500</td>
            </tr>
            <tr>
                <td>Timothy Mooney</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>37</td>
                <td>2008/12/11</td>
                <td>$136,200</td>
            </tr>
            <tr>
                <td>Jackson Bradshaw</td>
                <td>Director</td>
                <td>New York</td>
                <td>65</td>
                <td>2008/09/26</td>
                <td>$645,750</td>
            </tr>
            <tr>
                <td>Olivia Liang</td>
                <td>Support Engineer</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2011/02/03</td>
                <td>$234,500</td>
            </tr>
            <tr>
                <td>Bruno Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011/05/03</td>
                <td>$163,500</td>
            </tr>
            <tr>
                <td>Sakura Yamamoto</td>
                <td>Support Engineer</td>
                <td>Tokyo</td>
                <td>37</td>
                <td>2009/08/19</td>
                <td>$139,575</td>
            </tr>
            <tr>
                <td>Thor Walton</td>
                <td>Developer</td>
                <td>New York</td>
                <td>61</td>
                <td>2013/08/11</td>
                <td>$98,540</td>
            </tr>
            <tr>
                <td>Finn Camacho</td>
                <td>Support Engineer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009/07/07</td>
                <td>$87,500</td>
            </tr>
            <tr>
                <td>Serge Baldwin</td>
                <td>Data Coordinator</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2012/04/09</td>
                <td>$138,575</td>
            </tr>
            <tr>
                <td>Zenaida Frank</td>
                <td>Software Engineer</td>
                <td>New York</td>
                <td>63</td>
                <td>2010/01/04</td>
                <td>$125,250</td>
            </tr>
            <tr>
                <td>Zorita Serrano</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>56</td>
                <td>2012/06/01</td>
                <td>$115,000</td>
            </tr>
            <tr>
                <td>Jennifer Acosta</td>
                <td>Junior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>43</td>
                <td>2013/02/01</td>
                <td>$75,650</td>
            </tr>
            <tr>
                <td>Cara Stevens</td>
                <td>Sales Assistant</td>
                <td>New York</td>
                <td>46</td>
                <td>2011/12/06</td>
                <td>$145,600</td>
            </tr>
            <tr>
                <td>Hermione Butler</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>47</td>
                <td>2011/03/21</td>
                <td>$356,250</td>
            </tr>
            <tr>
                <td>Lael Greer</td>
                <td>Systems Administrator</td>
                <td>London</td>
                <td>21</td>
                <td>2009/02/27</td>
                <td>$103,500</td>
            </tr>
            <tr>
                <td>Jonas Alexander</td>
                <td>Developer</td>
                <td>San Francisco</td>
                <td>30</td>
                <td>2010/07/14</td>
                <td>$86,500</td>
            </tr>
            <tr>
                <td>Shad Decker</td>
                <td>Regional Director</td>
                <td>Edinburgh</td>
                <td>51</td>
                <td>2008/11/13</td>
                <td>$183,000</td>
            </tr>
            <tr>
                <td>Michael Bruce</td>
                <td>Javascript Developer</td>
                <td>Singapore</td>
                <td>29</td>
                <td>2011/06/27</td>
                <td>$183,000</td>
            </tr>
            <tr>
                <td>Donna Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011/01/25</td>
                <td>$112,000</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table -->

                        </div>
                    </form>
                    {{ $posts->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/js/form.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>



    
    
    


    <script type="text/javascript">
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
@endpush
