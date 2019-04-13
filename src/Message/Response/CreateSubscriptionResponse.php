<?php

namespace Omnipay\Mollie\Message\Response;

/**
 * @see https://docs.mollie.com/reference/v2/payments-api/create-payment
 */
class CreateSubscriptionResponse extends AbstractMollieResponse
{
    /**
     * @return string
     */
    public function getSubscriptionId()
    {
        if (isset($this->data['id'])) {
            return $this->data['id'];
        }
    }

    /**
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data['id']);
    }
}
