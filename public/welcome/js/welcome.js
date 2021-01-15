$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#search-user').on('keyup', function () {
        let searchString = $(this).val();
        if (searchString == '') {
            if ($('.found-users-div').length) {
                $('.found-users-div').remove();
            }
        } else {
            searchUser(searchString);
        }
    })

    function searchUser(searchString) {
        var _token = $("input[name='csrf-token']").val();
        $.ajax({
            type: 'GET',
            url: 'search-user',
            data: {
                _token: _token,
                keyword: searchString
            },
            dataType: 'json',
            success: function (data) {
                if ($('.found-users-div').length) {
                    $('.found-users-div').remove();
                }
                if (data.length) {
                    $('.friend-search-input-div').append('<div class="found-users-div" style="background-color:lightgrey;z-index: 9999">' +
                        '<table class="table">' +
                        '<thead class="thead-dark">' +
                        '<tr>' +
                        '<th scope="col">Image</th>' +
                        '<th scope="col">Name</th>' +
                        '<th scope="col">Surname</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody id="users-search-table">' +
                        '</tbody>' +
                        '</table>' +
                        '</div>');

                    $.each(data, function () {
                        $('#users-search-table').append('' +
                            '<tr id="user_'+this.id+'" class="user-tr">' +
                            '<th>' +
                                '<img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50" alt="Profile pic" width="50" height="50"> ' +
                            '</th>' +
                            '<th>'+this.name+'</th>' +
                            '<th>'+this.surname+'</th>' +
                            '</tr>');
                    });

                    $('.user-tr').css('line-height', '50px');

                    $('.user-tr').hover(function () {
                        $(this).css('cursor', 'pointer');
                    });

                    redirectToUserProfile();
                } else {
                    $('.friend-search-input-div').append('<div class="found-users-div bg-white">' +
                        '<p>Can`t find anyone</p></div>');
                }
            }
        })
    }

    function redirectToUserProfile() {
        $('.user-tr').on('click', function () {
            let userId = this.id.split("_")[1];
            let url = document.location.href+'/user/'+userId;
            window.location = url;
        })
    }

    $('.relationship-action').on('click', function () {
        let buttonAction = $(this).attr('id');
        createRelationship(buttonAction);
    })

    function createRelationship(buttonAction) {
        let receiverId = $('#profile-user-id').val();
        if (buttonAction === 'cancel-fr'){
            cancelOrDeleteFriendRequest(receiverId);
        }
        else if (buttonAction === 'delete'){
            cancelOrDeleteFriendRequest(receiverId);
        }
        else if (buttonAction === 'add-to-friends') {
            addToFriends(receiverId);
        }
        else {
            alert('Something went wrong !!!')
        }
    }

    function cancelOrDeleteFriendRequest(receiverId) {
        $.ajax({
            type: 'POST',
            url: 'cancel-or-delete',
            data: {
                receiverId: receiverId
            },
            dataType: 'json',
            success: function (data) {
                let res = JSON.parse(data)
                if (res === true) {
                    location.reload();
                }
                else {
                    alert('Something went wrong with server !!!')
                }
            }
        })
    }

    function addToFriends(receiverId) {
        $.ajax({
            type: 'POST',
            url: 'add-to-friend',
            data: {
                receiverId: receiverId
            },
            dataType: 'json',
            success: function (data) {
                location.reload();
                let res = JSON.parse(data)
                if (res === true) {
                    location.reload();
                }
                else {
                    alert('Something went wrong with server !!!')
                }
            }
        })
    }

})
