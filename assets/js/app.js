function commentPostAsync(postId) {
    const commentButton = document.getElementById('comment_button_' + postId);
    const commentsContainer = document.getElementById('comments_container_' + postId);

    const data = new URLSearchParams();
    data.append('post_id', postId);

    if(commentButton.innerHTML.includes('<i class="bi bi-chat-right"></i>')) {
        data.append('action', 'show_comments');
    } else {
        commentsContainer.innerHTML = '';
    }


    fetch('modules/post_actions_handler.php', {
        method: 'POST',
        body: data
    })
    .then(response => {
        if(!response.ok) {
            throw new Error('Error has occured: ', response.status);
        }
        return response.text();
    })
    .then(data => {
        if(commentButton.innerHTML.includes('<i class="bi bi-chat-right-fill"></i>')) {
            commentButton.innerHTML = '<i class="bi bi-chat-right"></i>';
            return;
        }

        const comments = JSON.parse(data).comments;
        const maxCommentsToShow = 5;

        commentButton.innerHTML = '<i class="bi bi-chat-right-fill"></i>';
        if(!comments || comments.length === 0) {
            commentsContainer.innerHTML = `<p class="pt-3 border-top border-black">No comments to display.</p>`;
            return;
        }

        for(i = 0; i < comments.length; i++) { 
            commentsContainer.innerHTML += `
            <div class="comment border-top border-black">
                <div class="row">
                    <div class="col-8">
                        <a href="show_profile.php?u_id=${comments[i].user_id}" class="text-decoration-none"><i class="bi bi-person-circle"></i> ${comments[i].username}</a>
                        <p class="text-start">${comments[i].comment}</p>
                    </div>
                    <div class="col-4">
                        <p><i class="bi bi-calendar3"></i> ${comments[i].comment_date}</p>
                </div>
            </div>
            `;

            if(i === maxCommentsToShow) {
                commentsContainer.innerHTML += `<p class="pt-3 border-top border-black" id='viewMoreComments'>View more comments...</p>`;
                break;
            }
        }

        const viewMoreCommentsButton = document.getElementById('viewMoreComments');
        if (viewMoreCommentsButton) {
            viewMoreCommentsButton.addEventListener('click', () => {
                viewMoreCommentsButton.style.display = 'none';
                for (let j = maxCommentsToShow + 1; j < comments.length; j++) {
                    commentsContainer.innerHTML += `
                    <div class="comment">
                        <div class="row">
                            <div class="col-8">
                                <a href="profile.php?user=${comments[j].user_id}" class="text-decoration-none">${comments[j].username}</a>
                                <p class="text-start">${comments[j].comment}</p>
                            </div>
                            <div class="col-4">
                                <p>${comments[j].comment_date}</p>
                            </div>
                        </div>
                    </div>
                    `;
                }
            });
        }
    })
    .catch(error => {
        console.error('Error has occured: ', error);
    });
}

function likePostAsync(postId) {
    const likeButton = document.getElementById('like_button_' + postId);

    const data = new URLSearchParams();
    data.append('post_id', postId);

    if(likeButton.innerHTML.includes('<i class="bi bi-hand-thumbs-up-fill"></i>')) {
        data.append('action', 'unlike');
    } else {
        data.append('action', 'like');
    }

    fetch('modules/post_actions_handler.php', {
        method: 'POST', // shouldnt be get ?
        body: data
    })
    .then(response => {
        if(!response.ok) {
            throw new Error('Error has occured: ', response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            if(likeButton.innerHTML.includes('<i class="bi bi-hand-thumbs-up-fill"></i>')) {
                likeButton.innerHTML = '<i class="bi bi-hand-thumbs-up"></i>';
            } else {
                likeButton.innerHTML = '<i class="bi bi-hand-thumbs-up-fill"></i>';
            }
        } else {
            console.error('Error has occured: ', data.message);
        }
    })
    .catch(error => {
        console.error('Error has occured: ', error);
    });
}

function bookmarkPostAsync(postId) {
    const bookmarkButton = document.getElementById('bookmark_button_' + postId);

    const data = new URLSearchParams();
    data.append('post_id', postId);

    if(bookmarkButton.innerHTML.includes('<i class="bi bi-bookmark-fill"></i>')) {
        data.append('action', 'unbookmark');
    } else {
        data.append('action', 'bookmark');
    }

    fetch('modules/post_actions_handler.php', {
        method: 'POST',
        body: data
    })
    .then(response => {
        if(!response.ok) {
            throw new Error('Error has occured: ', response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            if(bookmarkButton.innerHTML.includes('<i class="bi bi-bookmark-fill"></i>')) {
                bookmarkButton.innerHTML = '<i class="bi bi-bookmark"></i>';
            } else {
                bookmarkButton.innerHTML = '<i class="bi bi-bookmark-fill"></i>';
            }
        }
    })
    .catch(error => {     
        console.error('Error has occured: ', error);
    });
}

function followUserAsync(userId) {
    const followButton = document.getElementById('follow_button_' + userId);
    const followersCounter = document.getElementById('followers_counter_' + userId);

    const data = new URLSearchParams();
    data.append('usr_id', userId);

    if(followButton.innerText === 'Follow') {
        data.append('follow_action', 'follow');
    } else {
        data.append('follow_action', 'unfollow');
    }

    fetch('modules/user_actions_handler.php', {
        method: 'POST',
        body: data
    })
    .then(response => {
        if(!response.ok) {
            throw new Error('Error has occured: ', response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            if(followButton.innerText === 'Follow') {
                followButton.innerText = 'Unfollow';
                followersCounter.innerText = parseInt(followersCounter.innerText) + 1;
            } else {
                followButton.innerText = 'Follow';
                followersCounter.innerText = parseInt(followersCounter.innerText) - 1;
            }
        }
    })
    .catch(error => {
        console.error('Error has occured: ', error);
    });
}


