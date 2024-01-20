<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Trusthub
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Trusthub\V1;

use Twilio\Options;
use Twilio\Values;

abstract class TrustProductsOptions
{
    /**
     * @param string $statusCallback The URL we call to inform your application of status changes.
     * @return CreateTrustProductsOptions Options builder
     */
    public static function create(
        
        string $statusCallback = Values::NONE

    ): CreateTrustProductsOptions
    {
        return new CreateTrustProductsOptions(
            $statusCallback
        );
    }



    /**
     * @param string $status The verification status of the Customer-Profile resource.
     * @param string $friendlyName The string that you assigned to describe the resource.
     * @param string $policySid The unique string of a policy that is associated to the Customer-Profile resource.
     * @return ReadTrustProductsOptions Options builder
     */
    public static function read(
        
        string $status = Values::NONE,
        string $friendlyName = Values::NONE,
        string $policySid = Values::NONE

    ): ReadTrustProductsOptions
    {
        return new ReadTrustProductsOptions(
            $status,
            $friendlyName,
            $policySid
        );
    }

    /**
     * @param string $status
     * @param string $statusCallback The URL we call to inform your application of status changes.
     * @param string $friendlyName The string that you assigned to describe the resource.
     * @param string $email The email address that will receive updates when the Customer-Profile resource changes status.
     * @return UpdateTrustProductsOptions Options builder
     */
    public static function update(
        
        string $status = Values::NONE,
        string $statusCallback = Values::NONE,
        string $friendlyName = Values::NONE,
        string $email = Values::NONE

    ): UpdateTrustProductsOptions
    {
        return new UpdateTrustProductsOptions(
            $status,
            $statusCallback,
            $friendlyName,
            $email
        );
    }

}

class CreateTrustProductsOptions extends Options
    {
    /**
     * @param string $statusCallback The URL we call to inform your application of status changes.
     */
    public function __construct(
        
        string $statusCallback = Values::NONE

    ) {
        $this->options['statusCallback'] = $statusCallback;
    }

    /**
     * The URL we call to inform your application of status changes.
     *
     * @param string $statusCallback The URL we call to inform your application of status changes.
     * @return $this Fluent Builder
     */
    public function setStatusCallback(string $statusCallback): self
    {
        $this->options['statusCallback'] = $statusCallback;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Trusthub.V1.CreateTrustProductsOptions ' . $options . ']';
    }
}



class ReadTrustProductsOptions extends Options
    {
    /**
     * @param string $status The verification status of the Customer-Profile resource.
     * @param string $friendlyName The string that you assigned to describe the resource.
     * @param string $policySid The unique string of a policy that is associated to the Customer-Profile resource.
     */
    public function __construct(
        
        string $status = Values::NONE,
        string $friendlyName = Values::NONE,
        string $policySid = Values::NONE

    ) {
        $this->options['status'] = $status;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['policySid'] = $policySid;
    }

    /**
     * The verification status of the Customer-Profile resource.
     *
     * @param string $status The verification status of the Customer-Profile resource.
     * @return $this Fluent Builder
     */
    public function setStatus(string $status): self
    {
        $this->options['status'] = $status;
        return $this;
    }

    /**
     * The string that you assigned to describe the resource.
     *
     * @param string $friendlyName The string that you assigned to describe the resource.
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The unique string of a policy that is associated to the Customer-Profile resource.
     *
     * @param string $policySid The unique string of a policy that is associated to the Customer-Profile resource.
     * @return $this Fluent Builder
     */
    public function setPolicySid(string $policySid): self
    {
        $this->options['policySid'] = $policySid;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Trusthub.V1.ReadTrustProductsOptions ' . $options . ']';
    }
}

class UpdateTrustProductsOptions extends Options
    {
    /**
     * @param string $status
     * @param string $statusCallback The URL we call to inform your application of status changes.
     * @param string $friendlyName The string that you assigned to describe the resource.
     * @param string $email The email address that will receive updates when the Customer-Profile resource changes status.
     */
    public function __construct(
        
        string $status = Values::NONE,
        string $statusCallback = Values::NONE,
        string $friendlyName = Values::NONE,
        string $email = Values::NONE

    ) {
        $this->options['status'] = $status;
        $this->options['statusCallback'] = $statusCallback;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['email'] = $email;
    }

    /**
     * @param string $status
     * @return $this Fluent Builder
     */
    public function setStatus(string $status): self
    {
        $this->options['status'] = $status;
        return $this;
    }

    /**
     * The URL we call to inform your application of status changes.
     *
     * @param string $statusCallback The URL we call to inform your application of status changes.
     * @return $this Fluent Builder
     */
    public function setStatusCallback(string $statusCallback): self
    {
        $this->options['statusCallback'] = $statusCallback;
        return $this;
    }

    /**
     * The string that you assigned to describe the resource.
     *
     * @param string $friendlyName The string that you assigned to describe the resource.
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The email address that will receive updates when the Customer-Profile resource changes status.
     *
     * @param string $email The email address that will receive updates when the Customer-Profile resource changes status.
     * @return $this Fluent Builder
     */
    public function setEmail(string $email): self
    {
        $this->options['email'] = $email;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Trusthub.V1.UpdateTrustProductsOptions ' . $options . ']';
    }
}

