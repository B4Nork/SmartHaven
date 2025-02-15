<?php

class DeviceTypeService
{
    private DatabaseConnection $db;

    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db;
    }

    public function getDeviceTypes(): array
    {
        $query = 'SELECT id, name FROM DeviceType';

        return $this->queryToArray($query);
    }

    public function getDeviceTypeById(int $id): DeviceType
    {
        $query = 'SELECT id, name FROM DeviceType WHERE id = ' . $id;

        try {
            $deviceType = $this->db->query($query)[0];
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return new DeviceType($deviceType['id'], $deviceType['name']);
    }

    public function getDeviceTypeByName(string $name): DeviceType
    {
        $query = 'SELECT id, name FROM DeviceType WHERE name = "' . $name . '"';

        try {
            $deviceType = $this->db->query($query)[0];
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return new DeviceType($deviceType['id'], $deviceType['name']);
    }

    public function addDeviceType(DeviceType $deviceType): void
    {
        $query = 'INSERT INTO DeviceType (name) VALUES ("' . $deviceType->getName() . '")';

        try {
            $this->db->query($query);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function updateDeviceType(DeviceType $deviceType): void
    {
        $query = 'UPDATE DeviceType SET name = "' . $deviceType->getName() . '" WHERE id = ' . $deviceType->getId();

        try {
            $this->db->query($query);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteDeviceType(DeviceType $deviceType): void
    {
        $query = 'DELETE FROM DeviceType WHERE id = ' . $deviceType->getId();

        try {
            $this->db->query($query);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param string $query
     * @return array
     */
    public function queryToArray(string $query): array
    {
        try {
            $devicesTypes = $this->db->query($query);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $devicesTypesList = [];
        foreach ($devicesTypes as $deviceType) {
            $devicesTypesList[] = new DeviceType($deviceType['id'], $deviceType['name']);
        }

        return $devicesTypesList;
    }
}