@extends('layouts.app')

@section('title', 'Example')

@section('library_style')

@endsection

@section('custom_style')

@endsection

@section('breadcrumb')
    <div class="col-12 col-md-6 order-md-1 order-last">
        <h3>Blank Page</h3>
    </div>
    <div class="col-12 col-md-6 order-md-2 order-first">
        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Layout Vertical Navbar</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">Feedback Form</h4>
                        <p class="card-text">
                            Your feedback is instrumental in shaping our future. It guides our decisions, inspires
                            innovation, and ensures that we're meeting your needs. Whether you've had a stellar
                            experience or encountered any challenges, we want to hear from you. Your feedback fuels
                            our commitment to continuous improvement.
                        </p>
                        <form class="form" method="post">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="feedback1" class="sr-only">Name</label>
                                    <input type="text" id="feedback1" class="form-control" placeholder="Name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="feedback4" class="sr-only">Last Game</label>
                                    <input type="text" id="feedback4" class="form-control" placeholder="Last Name" name="LastName">
                                </div>
                                <div class="form-group">
                                    <label for="feedback2" class="sr-only">Email</label>
                                    <input type="email" id="feedback2" class="form-control" placeholder="Email" name="email">
                                </div>
                                <div class="form-group">
                                    <select name="reason" class="form-control">
                                        <option value="Inquiry">Inquiry</option>
                                        <option value="Complain">Complaints</option>
                                        <option value="Quotation">Quotation</option>
                                    </select>
                                </div>
                                <div class="form-group form-label-group">
                                    <textarea class="form-control" id="label-textarea" rows="3" placeholder="Suggestion"></textarea>
                                    <label for="label-textarea"></label>
                                </div>
                            </div>
                            <div class="form-actions d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                <button type="reset" class="btn btn-light-primary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">Feedback Form</h4>
                        <p class="card-text">
                            Your feedback is instrumental in shaping our future. It guides our decisions, inspires
                            innovation, and ensures that we're meeting your needs. Whether you've had a stellar
                            experience or encountered any challenges, we want to hear from you. Your feedback fuels
                            our commitment to continuous improvement.
                        </p>
                        <form class="form" method="post">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="feedback1" class="sr-only">Name</label>
                                    <input type="text" id="feedback1" class="form-control" placeholder="Name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="feedback4" class="sr-only">Last Game</label>
                                    <input type="text" id="feedback4" class="form-control" placeholder="Last Name" name="LastName">
                                </div>
                                <div class="form-group">
                                    <label for="feedback2" class="sr-only">Email</label>
                                    <input type="email" id="feedback2" class="form-control" placeholder="Email" name="email">
                                </div>
                                <div class="form-group">
                                    <select name="reason" class="form-control">
                                        <option value="Inquiry">Inquiry</option>
                                        <option value="Complain">Complaints</option>
                                        <option value="Quotation">Quotation</option>
                                    </select>
                                </div>
                                <div class="form-group form-label-group">
                                    <textarea class="form-control" id="label-textarea" rows="3" placeholder="Suggestion"></textarea>
                                    <label for="label-textarea"></label>
                                </div>
                            </div>
                            <div class="form-actions d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                <button type="reset" class="btn btn-light-primary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">Feedback Form</h4>
                        <p class="card-text">
                            Your feedback is instrumental in shaping our future. It guides our decisions, inspires
                            innovation, and ensures that we're meeting your needs. Whether you've had a stellar
                            experience or encountered any challenges, we want to hear from you. Your feedback fuels
                            our commitment to continuous improvement.
                        </p>
                        <form class="form" method="post">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="feedback1" class="sr-only">Name</label>
                                    <input type="text" id="feedback1" class="form-control" placeholder="Name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="feedback4" class="sr-only">Last Game</label>
                                    <input type="text" id="feedback4" class="form-control" placeholder="Last Name" name="LastName">
                                </div>
                                <div class="form-group">
                                    <label for="feedback2" class="sr-only">Email</label>
                                    <input type="email" id="feedback2" class="form-control" placeholder="Email" name="email">
                                </div>
                                <div class="form-group">
                                    <select name="reason" class="form-control">
                                        <option value="Inquiry">Inquiry</option>
                                        <option value="Complain">Complaints</option>
                                        <option value="Quotation">Quotation</option>
                                    </select>
                                </div>
                                <div class="form-group form-label-group">
                                    <textarea class="form-control" id="label-textarea" rows="3" placeholder="Suggestion"></textarea>
                                    <label for="label-textarea"></label>
                                </div>
                            </div>
                            <div class="form-actions d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                <button type="reset" class="btn btn-light-primary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection

@section('library_script')

@endsection

@section('custom_script')

@endsection
