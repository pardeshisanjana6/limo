@extends('admin.adminlayout')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manage Contact Queries</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Contact Queries</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Received At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($queries as $query)
                        <tr>
                            <td>{{ $query->id }}</td>
                            <td>{{ $query->name }}</td>
                            <td>{{ $query->email }}</td>
                            <td>{{ $query->subject }}</td>
                            <td>{{ $query->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#queryModal-{{ $query->id }}">
                                    View Message
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="queryModal-{{ $query->id }}" tabindex="-1" role="dialog" aria-labelledby="queryModalLabel-{{ $query->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="queryModalLabel-{{ $query->id }}">Message from {{ $query->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Email:</strong> {{ $query->email }}</p>
                                        <p><strong>Subject:</strong> {{ $query->subject }}</p>
                                        <hr>
                                        <p>{{ $query->message }}</p>
                                        
                                        <form action="{{ route('admin.contact.reply', $query->id) }}" method="POST" class="mt-4">
                                            @csrf
                                            <div class="form-group">
                                                <label for="reply_message-{{ $query->id }}">Reply to user</label>
                                                <textarea class="form-control" id="reply_message-{{ $query->id }}" name="reply_message" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-2">Send Reply</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection