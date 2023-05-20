@extends('layouts.frontend') @section('content')

<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Create Product</h3>
                </div>
                <div class="card-body">
                    <form
                        action="/products"
                        method="POST"
                        enctype="multipart/form-data"
                    >
                        @csrf
                        <div class="mb-3 mt-3">
                            <label class="form-label"> Name:</label>
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                required
                            />
                        </div>

                        <div class="mb-3 mt-3">
                            <label class="form-label"> Price:</label>
                            <input
                                type="number"
                                step="0.01"
                                class="form-control"
                                name="price"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label class="form-label"> Description:</label>
                            <textarea
                                name="description"
                                cols="30"
                                rows="10"
                                class="form-control"
                                required
                            >
                            </textarea>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="type" class="form-label"> Type</label>
                            <select class="form-select" name="type">
                                <option value="Fruit And Vegetable"> Fruit And Vegetable </option>
                                <option value="Bread And Cake"> Bread And Cake </option>
                                <option value="Milk"> Milk </option>
                            </select>
                            <br />
                        </div>
                        <div class="mb-3">
                            <label class="form-label"> Image:</label>
                            <input
                                type="file"
                                accept="image/*"
                                class="form-control"
                                name="image"
                                required
                            />
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
