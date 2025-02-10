<x-app-layout>
    <x-slot name="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="h4">
                        {{ __('Data Feeds') }}
                    </h2>
                </div>

                <div class="col-lg-4">
                    <form class="d-flex " role="search">
                        <input class="form-control me-2 rounded" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i> </button>
                      </form>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row">
            <div class="col-md-12">
                <!-- Konten Utama -->
                <div class="card">
                    <div class="card-body">
                       <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label class="input-group-text" for="inputGroupSelect01"><i class="bi bi-funnel"></i></label>
                                        <select class="form-select" id="inputGroupSelect01">
                                          <option selected>All</option>
                                          <option value="1">Created by Me</option>
                                          <option value="2">Starred Metrics</option>
                                          <option value="3">Certified Metrics</option>
                                          <option value="4">Not Shared with Me</option>
                                          <option value="5">Shared with me</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label class="input-group-text" for="inputGroupSelect02"><i class="bi bi-wrench-adjustable"></i> </label>
                                        <select class="form-select" id="inputGroupSelect02">
                                          <option selected>All</option>
                                          <option value="1">Created by Me</option>
                                          <option value="2">Starred Metrics</option>
                                          <option value="3">Certified Metrics</option>
                                          <option value="4">Not Shared with Me</option>
                                          <option value="5">Shared with me</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input type="date" class="form-control rounded" id="datepicker" name="datepicker">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Owner</th>
                                                <th scope="col">Created At</th>
                                                <th scope="col">Last Refreshed</th>
                                                <th scope="col">Metrics</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Data 1</th>
                                                <td>Mark</td>
                                                <td>12/12/2021</td>
                                                <td>12/12/2021</td>
                                                <td>12/12/2021</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                    </table>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
