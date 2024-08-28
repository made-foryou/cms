<?php

namespace Made\Cms\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class PermissionQueryBuilder extends Builder
{
    /**
     * Returns a new instance of the current class with the given subject and key.
     *
     * @param  string  $subject  The subject to set
     * @param  string  $key  The key to set
     * @return self A new instance of the current class with the updated subject and key
     */
    public function is(string $subject, string $key): self
    {
        return $this->subject($subject)->key($key);
    }

    /**
     * Sets the subject value for the query.
     *
     * @param  string  $subject  The subject value to set.
     * @return self The current instance of the class.
     */
    public function subject(string $subject): self
    {
        return $this->where('subject', $subject);
    }

    /**
     * Sets the key value for the query.
     *
     * @param  string  $key  The key value to set.
     * @return self The current instance of the class.
     */
    public function key(string $key): self
    {
        return $this->where('key', $key);
    }
}
