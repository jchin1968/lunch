<?php

namespace Drupal\lunch\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

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

    $start = new \DateTime();
    $end = new \DateTime('+10 days');
    $interval = new \DateInterval('P1D');
    $range = new \DatePeriod($start, $interval, $end);

    $date_options = [];
    foreach($range as $date){
      $formatted_date = $date->format('Y-m-d');
      $date_options[$formatted_date] = $formatted_date;
    }

    $form['delivery_date'] = [
      '#type' => 'select',
      '#title' => $this->t('Delivery Date'),
      '#options' => $date_options,
      '#required' => TRUE,
    ];

    $form['delivery_time'] = [
      '#type' => 'radios',
      '#title' => $this->t('Delivery Time'),
      '#options' => [1 => '11:30am', 2 => '12:00pm', 3 => '12:30pm', 4 => '1:00pm',],
      '#required' => TRUE,
    ];

    $form['menu_choices'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Menu Choices'),
      '#options' => [
        $this->t('Chicken Rice'),
        $this->t('Fried Noodles'),
        $this->t('Soup and Sandwich'),
        $this->t('Pizza'),
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
    $fullname = $form_state->getValue('fullname');
    drupal_set_message($this->t('Thank you, @fullname, for your order', ['@fullname' => $fullname]), 'status');
  }
}
