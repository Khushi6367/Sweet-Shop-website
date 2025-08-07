@extends('layouts.admin')

@section('content')
    <form action="/product" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container border p-4">
            <div class="text-primary h3 text-center text-decoration-underline">
                Create New Product
            </div>
            @if ($errs = $errors->all())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errs as $er)
                            <li> {{ $er }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Name"
                    value="{{ old('name') ?? 'Soan Papdi' }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="flavour" class="form-label">Product Flavour</label>
                <input type="text" autofocus name="flavour" id="flavour" placeholder="Enter flavour"
                    class="form-control" value="{{ old('flavour') ?? 'Regular' }}" list="sug">
                <datalist id="sug">
                    <option value="Almond & Pistachio">
                    <option value="Chocolate">
                    <option value="Coconut">
                    <option value="Elaichi">
                    <option value="Orange">
                    <option value="Regular">
                    <option value="Rose">
                </datalist>
            </div>
            <div id="main">
                <div class="row mb-3" id="child_1">
                    <div class="col-md-6 col-lg-3">
                        <label for="madewith">Made With</label>
                        <select class="form-select" name="price[madewith][]" id="madewith">
                            <option>Edible Vegetable Oil (Refined Palmolein Oil)</option>
                            <option>Clarified Butter (Desi Ghee)</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <label for="ingredients">Ingredients</label>
                        <select class="form-select" name="price[ingredients][]" id="ingredients">
                            <option>Sugar, Edible Vegetable Oil (Palmoein Oil), Refined Wheat Flour, Gram Flour, Liquid
                                Glucose, Cardamomo Powder etc.</option>
                            <option>Sugar, Clarified Butter (Desi Ghee), Refined Wheat Flour, Gram Flour, Liquid Glucose,
                                Almonds, Pistachio and Cardamom.</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <label for="shelflife">Shelf Life</label>
                        <select class="form-select" name="price[shelflife][]" id="shelflife">
                            <option>3 months</option>
                            <option>6 months</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <label for="availability">Availability</label>
                        <select class="form-select" name="price[availability][]" id="availability">
                            <option>In Stock</option>
                            <option>Out Of Stock</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <label for="weight">Weight</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" name="price[weight][]" placeholder="Weight"
                                min="0">
                            <select class="btn btn-light" name="price[weight_type][]">
                                <option>gm</option>
                                <option>kg</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <label for="price">Price</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">₹</span>
                            <input type="number" name="price[price][]" placeholder="Price" class="form-control"
                                min="0">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <label for="finalprice">Final Price</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">₹</span>
                            <input type="number" name="price[finalprice][]" placeholder="Final Price" class="form-control"
                                min="0">
                        </div>
                    </div>

                </div>
            </div>
            <div class="mb-3">
                <input type="hidden" value="1" id="tot">
                <button class="btn btn-success" onclick="cClone()" type="button">Add</button>
                <button class="btn btn-danger" onclick="rClone()" type="button">Remove</button>
            </div>
            <div class="mb-3">
                <label for="main_image" class="form-label">Image</label>
                <input class="form-control" type="file" id="main_image" accept="image/*" name="main_image">
            </div>
            <div class="mb-3">
                <label for="other_image" class="form-label">Other Image/Video</label>
                <input class="form-control" multiple type="file" id="other_image" accept="image/*,video/*"
                    name="other_image[]">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" placeholder="Description" id="description" class="form-control" cols="30"
                    rows="6">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3 text-center">
                <button class="btn btn-success">Save</button>
            </div>
        </div>
    </form>
    <script>
        function cClone() {
            tot.value = parseInt(tot.value) + 1;
            let obj = child_1.cloneNode(true);
            obj.id = "child_" + tot.value;
            main.appendChild(obj);
        }

        function rClone() {
            if (Number(tot.value) > 1) {
                let obj = document.getElementById('child_' + tot.value);
                main.removeChild(obj);
                tot.value = parseInt(tot.value) - 1;
            } else {
                alert("You can't Delete it");
            }
        }
    </script>
@endsection
