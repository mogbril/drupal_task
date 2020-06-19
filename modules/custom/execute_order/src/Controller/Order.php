<?php

/**
 * @file
 * Contains \Drupal\execute_order\Controller\Order
 */

namespace Drupal\execute_order\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\Response;

class Order extends ControllerBase {

    /**
     * Execute the order
     */
    public function execute() {
        
        if (\Drupal::currentUser()->isAuthenticated()) {
            if (isset($_REQUEST['title']) && isset($_REQUEST['product_nid']) && isset($_REQUEST['product_nid'])) {
                $title = $_REQUEST['title'];
                $product_nid = $_REQUEST['product_nid'];
                $quantity = $_REQUEST['quantity'];
                // Create order.
                $node = Node::create([
                            'type' => 'orders',
                            'uid' => \Drupal::currentUser()->id(),
                            'title' => $title,
                            'field_orders_product' => $product_nid,
                            'field_orders_quantity' => $quantity,
                            'field_ordered_by' => \Drupal::currentUser()->id(),
                ]);
                $node->save();
                return new Response('Order hase been done successfully!');
            }
        }

        return;
    }

}
