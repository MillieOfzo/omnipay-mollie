<?php

namespace Omnipay\Mollie\Message\Response;

/**
 * @see https://docs.mollie.com/reference/v2/mandates-api/create-mandate
 */
class RevokeSubscriptionResponse extends AbstractMollieResponse
{
	/**
     * @return bool
     */
    public function isSuccessful()
    {
        return isset($this->data['id']);
    }
}
