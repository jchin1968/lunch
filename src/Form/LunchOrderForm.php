<?php

namespace Drupal\lunch\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;

class LunchOrderForm extends FormBase {

  public function getFormId() {
    return 'lunch_order_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['fullname'] =[
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#required' => TRUE,
    ];

    $form['delivery_date'] = [
      '#type' => 'date',
      '#title' => $this->t('Delivery Date'),
      '#required' => TRUE,
     ];

    $form['delivery_time'] = [
      '#type' => 'radios',
      '#title' => $this->t('Delivery Time'),
      '#options' => [1 => '11:30am', 2 => '12:00pm', 3 => '12:30pm', 4 => '1:00pm',],
      '#required' => TRUE,
    ];

    $form['menu_selection'] = [
      '#type' => 'select',
      '#title' => $this->t('Menu Selection'),
      '#options' => [
        1 => $this->t('Chicken Rice'),
        2 => $this->t('Fried Noodles'),
        3 => $this->t('Soup and Sandwich'),
        4 => $this->t('Pizza'),
      ],
      '#required' => TRUE,
    ];

    $form['instructions'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Special Instructions'),
      '#rows' => 2,
    ];

    $form['order_submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message($this->t('Thank you for your order'), 'status');
  }
}
