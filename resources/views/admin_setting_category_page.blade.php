@extends('layouts.app')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <!-- Modal -->
                    <div class="modal fade" id="addTag" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content dark-edition">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">Add New Tag</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="text-white" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.setting.company.tag.create')}}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="tag_create" placeholder="Name" required>
                                            <div class="input-group-append">
                                              <button class="btn btn-outline-secondary btn-sm" type="submit">Create</button>
                                            </div>
                                          </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="card-header card-header-primary">
                        <h4 class="card-title float-left m-0">Tag List</h4>
                        <a href="#" class="float-right" data-toggle="modal" data-target="#addTag"><i class="fas fa-plus-square mr-1"></i>New</a>
                    </div>
                    <div class="card-body pb-0">
                        <table class="table" id="dtHorizontal" cellspacing="0" width="100%">
                            <thead class="text-primary">
                                <tr>
                                    <th class="text-white">Name</th>
                                    <th class="text-right text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $item)
                                    <tr>
                                        <td class="text-white">{{$item->tag}}</td>
                                        <td class="text-right text-white">
                                            <a href="#" data-toggle="modal" data-target="#editTag{{$item->id}}"><i class="fas fa-pen-square text-warning"></i></a>
                                            <a href="#" data-toggle="modal" data-target="#deleteTag{{$item->id}}"><i class="fas fa-trash-alt text-danger ml-2"></i></a>
                                            <div class="modal fade" id="editTag{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                    <div class="modal-content dark-edition">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-white">Edit Tag</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span class="text-white" aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('admin.setting.company.tag.edit', ['id' => $item->id])}}" method="POST">
                                                                @csrf
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" name="tag_edit" value="{{$item->tag}}" required>
                                                                    <div class="input-group-append">
                                                                    <button class="btn btn-outline-secondary btn-sm" type="submit">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="deleteTag{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                    <div class="modal-content dark-edition">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-white">Delete Tag</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span class="text-white" aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body d-flex justify-content-center align-items-center">
                                                            <h5 class="mb-0">Delete this tag?</h5>
                                                            <form action="{{route('admin.setting.company.tag.delete', ['id' => $item->id])}}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger rounded-pill ml-2"><i class="fas fa-check mr-2"></i>Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card">
                    <!-- Modal -->
                    <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content dark-edition">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">Add New Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="text-white" aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.setting.company.category.create')}}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="category_create" placeholder="Name" required>
                                            <div class="input-group-append">
                                              <button class="btn btn-outline-secondary btn-sm" type="submit">Create</button>
                                            </div>
                                          </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="card-header card-header-primary">
                        <h4 class="card-title float-left m-0">Category List</h4>
                        <a href="#" class="float-right" data-toggle="modal" data-target="#addCategory"><i class="fas fa-plus-square mr-1"></i>New</a>
                    </div>
                    <div class="card-body pb-0">
                        <table class="table" id="dtHorizontal-1" cellspacing="0" width="100%">
                            <thead class="text-primary">
                                <tr>
                                    <th class="text-white">Name</th>
                                    <th class="text-right text-white">Visiable</th>
                                    <th class="text-right text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $item)
                                    @if ($item->id > 1)
                                        <tr>
                                            <td class="text-white">{{$item->category}}</td>
                                            <td class="text-right text-white"><i class="far fa-eye{{($item->show == false) ? '-slash' : ''}}"></i></td>
                                            <td class="text-right text-white">
                                                <a href="#" data-toggle="modal" data-target="#editCategory{{$item->id}}"><i class="fas fa-pen-square text-warning"></i></a>
                                                <div class="modal fade" id="editCategory{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                        <div class="modal-content dark-edition">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-white">Edit Category</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span class="text-white" aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{route('admin.setting.company.category.edit', ['id' => $item->id])}}" method="POST">
                                                                    @csrf
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" name="category_edit" value="{{$item->category}}" required>
                                                                        <div class="input-group-append">
                                                                        <button class="btn btn-outline-secondary btn-sm" type="submit">Edit</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($item->id > 9)
                                                    <a href="#" data-toggle="modal" data-target="#deleteCategory{{$item->id}}"><i class="fas fa-trash-alt text-danger ml-2"></i></a>
                                                    <div class="modal fade" id="deleteCategory{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                            <div class="modal-content dark-edition">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-white">Delete Category</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span class="text-white" aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body d-flex justify-content-center align-items-center">
                                                                    <h5 class="mb-0">Delete this category?</h5>
                                                                    <form action="{{route('admin.setting.company.category.delete', ['id' => $item->id])}}" method="POST">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-sm btn-danger rounded-pill ml-2"><i class="fas fa-check mr-2"></i>Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection