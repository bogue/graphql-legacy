<?php

namespace Drupal\graphql_image\Plugin\GraphQL\Fields;

use Drupal\graphql\Plugin\GraphQL\Fields\FieldPluginBase;
use Drupal\image\Plugin\Field\FieldType\ImageItem;
use Youshido\GraphQL\Execution\ResolveInfo;

/**
 * Retrieve the image url.
 *
 * @GraphQLField(
 *   id = "image_style_url",
 *   secure = true,
 *   name = "url",
 *   type = "String",
 *   nullable = true,
 *   parents = {"ImageResource"}
 * )
 */
class ImageResourceUrl extends FieldPluginBase {

  /**
   * {@inheritdoc}
   */
  protected function resolveValues($value, array $args, ResolveInfo $info) {
    if ($value instanceof ImageItem && $value->entity->access('view')) {
      yield file_create_url($value->entity->getFileUri());
    }
    if (is_array($value) && array_key_exists('url', $value)) {
      yield $value['url'];
    }
  }

}
