<?php

namespace app\components;

use Yii;
use yii\base\Component;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class MinioComponent extends Component
{
	public $accessKey;
	public $secretKey;
	public $region = 'us-east-1';
	public $endpoint;
	public $bucket;

	private $_client;

	public function init() {
		parent::init();

		$this->_client = new S3Client([
			'version' => 'latest',
			'region' => $this->region,
			'endpoint' => $this->endpoint,
			'use_path_style_endpoint' => true,
			'credentials' => [
				'key' => $this->accessKey,
				'secret' => $this->secretKey,
			]
		]);
	}

	public function upload($key, $body) {
		$params = [
			'Bucket' => $this->bucket,
			'Key' => $key,
			'Body' => $body,
			'ACL' => 'private'
		];

		return $this->_client->putObject($params);
	}

	public function getFile($key) {
		$result = $this->_client->getObject([
			'Bucket' => $this->bucket,
			'Key' => $key
		]);

		$body = $result['Body'];
		return $body->getContents();
	}

	public function delete($key) {
		$result = $this->_client->deleteObject([
			'Bucket' => $this->bucket,
			'Key' => $key
		]);

		return $result['DeleteMarker'] ?? false;
	}
}