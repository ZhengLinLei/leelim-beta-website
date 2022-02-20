<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Productos en venta</h1>
    <p class="mb-4">Añadir productos</p>
    <p class="my-5 p-2 bg-danger text-white">Por favor, revise atentamente todo los detalles. Cualquier error los clientes lo veràn de inmediato. Y eso no queremos</p>
    <div class="my-5 py-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Añadir</h6>
            </div>
            <div class="card-body">
                <div class="my-5">
                    <form action="/" method="POST" id="productForm">
                        <div class="form-group pt-5 mb-5">
                            <label for="product-code" class="b">Product Code</label>
                            <input type="text" class="form-control" id="product-code" name="product_code" placeholder="Codigo unico del producto" required>
                            <div class="mt-4 small">Comprueba si el codigo existe <a href="/product/?type=remove">AQUI</a></div>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <label for="product-name" class="b">Nombre</label>
                            <input type="text" class="form-control" id="product-name" name="name" placeholder="Nombre del producto" required>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <label for="product-name" class="b">Temporada</label>
                            <input type="text" class="form-control" list="season-tag" id="product-season" name="season" placeholder="Temporada del producto" required>
                            <datalist id="season-tag">
                                <?php
                                foreach ($_SESSION['season']['tag'] as $key => $value):
                                ?>
                                <option value="<?=$value['name']?>"><?=$value['name']?></option>
                                <?php
                                endforeach;
                                ?>
                            </datalist>
                            <!-- -- -->
                            <div class="mt-4 small">Puedes ver las temporadas vigentes <a href="/season/?type=tag">AQUI</a></div>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <label for="product-description" class="b">Descripción</label>
                            <textarea name="description" id="product-description" cols="30" rows="10" class="form-control" required></textarea>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <label for="product-material" class="b">Material del producto</label>
                            <textarea name="material" id="product-material" cols="30" rows="10" class="form-control" required></textarea>
                            <div class="mt-4 small">Ejemplo: 3% Spandex, 37% Polyester, 60% Silk</div>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <label for="product-category" class="b">Categoria</label>
                            <select name="category" id="product-category" class="form-control" required>
                                <option value="clothing">Ropa</option>
                                <option value="accessory">Accesorios</option>
                                <option value="bag">Bolsos</option>
                                <option value="shoe">Zapatos</option>
                            </select>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <label for="product-gender" class="b">Genero</label>
                            <select name="gender" id="product-gender" class="form-control" required>
                                <option value="unisex">Unisex</option>
                                <option value="woman">Mujer</option>
                                <option value="man">Hombre</option>
                            </select>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <label for="product-price" class="b">Precio</label>
                            <input type="number" name="price" id="product-price" class="form-control" placeholder="24.05" step="0.01" required>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <label for="product-color" class="b">Colores</label>
                            <input type="text" name="color" id="product-color" class="form-control" placeholder="En Hexadecimal Ej. #ffffff,#000000" required>
                            <div class="mt-4 small p-1 bg-primary b text-white">Separar con comas sin espacios. Ej: #e0e0e0,#45f45f,#ffffff. En caso de un producto de un solo color se deja vacio o inserte el unico color que tiene</div>
                            <div class="my-5">
                                <label for="product-color-img" class="b">Imagen descripción de colores</label>
                                <input type="file" name="color_img" class="form-control-file" id="product-color-img" accept="image/*,.gif,.webp" required>
                                <div class="my-2">
                                    <img id="blah-color" src="" class="w-25" alt="La imagen se mostrara aquí" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <label for="product-size" class="b">Tallas</label>
                            <input type="text" name="size" id="product-size" class="form-control" placeholder="En Sistema universal. Ej. XS,S,M,L,XL" required>
                            <div class="mt-4 small p-1 bg-primary b text-white">Separar con comas sin espacios. Ej: XS,S,M,L. En caso de un producto de una sola talla se deja vacio o inserte la unica talla disponible.</div>
                            <div class="my-5">
                                <label for="product-size-img" class="b">Imagen de las medidas de las tallas</label>
                                <input type="file" name="size_img" class="form-control-file" id="product-size-img" accept="image/*,.gif,.webp" required>
                                <div class="my-2">
                                    <img id="blah-size" src="" class="w-25" alt="La imagen se mostrara aquí" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <p class="b">Imagenes</p>
                            <div class="my-5">
                                <label for="product-cover-img" class="b">Imagen de portada</label>
                                <input type="file" name="cover_img" class="form-control-file" id="product-cover-img" accept="image/*,.gif,.webp" required>
                                <div class="my-2">
                                    <img id="blah-cover" src="" class="w-25" alt="La imagen se mostrara aquí" />
                                </div>
                            </div>
                            <div class="my-5">
                                <label for="product-hover-img" class="b">Imagen de Hover (cuando pasa el cursor)</label>
                                <input type="file" name="hover_img" class="form-control-file" id="product-hover-img" accept="image/*,.gif,.webp" required>
                                <div class="my-2">
                                    <img id="blah-hover" src="" class="w-25" alt="La imagen se mostrara aquí" />
                                </div>
                            </div>
                            <div class="my-5">
                                <label for="product-extra-img" class="b">Imagenes extras de muestra</label>
                                <input type="file" name="extra_img[]" class="form-control-file" id="product-extra-img" accept="image/*,.gif,.webp" multiple required>
                            </div>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <div class="mt-5 d-flex justify-content-end px-5">
                                <button type="submit" class="btn btn-primary px-5 py-3">Publicar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/static/js/src/product_add.js" defer></script>