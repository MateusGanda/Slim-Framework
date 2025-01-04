<?php

namespace app\controllers\admin;

use app\controllers\Controller;
use app\models\admin\Post;
use app\src\Image;
use app\src\Validate;

class PostsPhotoController extends Controller {

	public function update($request, $response, $args) {

		$validate = new Validate;

		$validate->validate([
			'file' => 'image',
		]);

		if ($validate->hasErrors()) {
			return back();
		}

		$post = new Post;

		$postEncontrado = $post->findBy('id', $args['id']);

		$image = new Image('file');

		$image->delete($postEncontrado->photo);

		$image->size('post')->upload();

		$post->find('id', $args['id'])->update([
			'photo' => "/assets/imgs/photos/{$image->getName()}",
		]);

		flash('message_upload_photo_post', success('Upload feito com sucesso'));

		back();

	}

}
