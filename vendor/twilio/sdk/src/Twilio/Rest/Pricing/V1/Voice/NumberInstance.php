<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Pricing
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Pricing\V1\Voice;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;


/**
 * @property string|null $number
 * @property string|null $country
 * @property string|null $isoCountry
 * @property string|null $outboundCallPrice
 * @property string|null $inboundCallPrice
 * @property string|null $priceUnit
 * @property string|null $url
 */
class NumberInstance extends InstanceResource
{
    /**
     * Initialize the NumberInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $number The phone number to fetch.
     */
    public function __construct(Version $version, array $payload, string $number = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'number' => Values::array_get($payload, 'number'),
            'country' => Values::array_get($payload, 'country'),
            'isoCountry' => Values::array_get($payload, 'iso_country'),
            'outboundCallPrice' => Values::array_get($payload, 'outbound_call_price'),
            'inboundCallPrice' => Values::array_get($payload, 'inbound_call_price'),
            'priceUnit' => Values::array_get($payload, 'price_unit'),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['number' => $number ?: $this->properties['number'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return NumberContext Context for this NumberInstance
     */
    protected function proxy(): NumberContext
    {
        if (!$this->context) {
            $this->context = new NumberContext(
                $this->version,
                $this->solution['number']
            );
        }

        return $this->context;
    }

    /**
     * Fetch the NumberInstance
     *
     * @return NumberInstance Fetched NumberInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): NumberInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Pricing.V1.NumberInstance ' . \implode(' ', $context) . ']';
    }
}

