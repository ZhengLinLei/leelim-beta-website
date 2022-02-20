<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">FotoGaleria de Sesiones de Temporada</h1>
    <p class="mb-4">Añadir Sesion</p>
    <div class="my-5 py-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Añadir</h6>
            </div>
            <div class="card-body">
                <div class="my-5">
                    <form action="/" method="POST" id="productForm">
                        <div class="form-group pt-5 mb-5">
                            <label for="product-name" class="b">Nombre</label>
                            <input type="text" class="form-control" id="product-name" name="name" placeholder="Nombre" required>
                            <div class="small mt-3">El nombre es unico</div>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <label for="product-name" class="b">Temporada</label>
                            <input type="text" class="form-control" list="season-tag" id="product-season" name="season" placeholder="Temporada" required>
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
                            <p class="b">Imagenes</p>
                            <div class="my-5">
                                <label for="product-cover-img" class="b">Imagen de portada</label>
                                <input type="file" name="cover_img" class="form-control-file" id="product-cover-img" accept="image/*,.gif,.webp" required>
                                <div class="my-2">
                                    <img id="blah-cover" src="" class="w-25" alt="La imagen se mostrara aquí" />
                                </div>
                            </div>
                            <div class="my-5">
                                <label for="product-extra-img" class="b">Imagenes extras de muestra</label>
                                <input type="file" name="extra_img[]" class="form-control-file" id="product-extra-img" accept="image/*,.gif,.webp" multiple required>
                            </div>
                        </div>
                        <div class="form-group border-top pt-5 mb-5">
                            <label for="product-product" class="b">Producto</label>
                            <input type="text" name="product" id="product-product" class="form-control" placeholder="En Codigo Ej. XXX,XXX" required>
                            <div class="mt-4 small p-1 bg-primary b text-white">Separar con comas sin espacios. Ej: XXX,XXX,XXX. Puede ver los codigos de los productos <a href="/product/?type=remove" class="text-white" target="_blank">AQUI</a></div>
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
<script src="/static/js/src/season_gallery.js" defer></script>