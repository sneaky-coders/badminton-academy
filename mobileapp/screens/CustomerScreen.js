// CustomerScreen.js
import React, { useState, useEffect } from 'react';
import { View, Text, ScrollView, StyleSheet, Modal, TouchableOpacity , Image} from 'react-native';
import { Table, Row } from 'react-native-table-component';
import { Card, Icon } from 'react-native-elements';


const CustomerScreen = ({ navigation }) => {
  const [customers, setCustomers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [selectedCustomer, setSelectedCustomer] = useState(null);
  const [isModalVisible, setModalVisible] = useState(false);
  const profile = require("../assets/user.jpg");

  useEffect(() => {
    // Fetch customer data when the component mounts
    fetchCustomerData();
  }, []);

  const fetchCustomerData = async () => {
    try {
      const response = await fetch('http://192.168.0.9:3001/api/customer');

      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }

      const data = await response.json();

      // Assuming the API response contains an array of customers
      setCustomers(data.customers);
      setLoading(false);
    } catch (error) {
      console.error('Error fetching customer data:', error);
      setError('Error fetching customer data. Please try again.');
      setLoading(false);
    }
  };

  const handleView = (customer) => {
    setSelectedCustomer(customer);
    setModalVisible(true);
  };

  const renderTableData = () => {
    return customers.map((customer) => (
      <Row
        key={customer.id}
        data={[
          customer.id.toString(),
          customer.name,
          customer.email,
          <TouchableOpacity onPress={() => handleView(customer)}>
            <Icon name="eye" type="font-awesome" color="#517fa4" />
          </TouchableOpacity>,
        ]}
        textStyle={styles.text}
      />
    ));
  };

  return (
    <ScrollView>
      <View style={styles.container}>
        {loading && <Text>Loading...</Text>}
        {error && <Text style={styles.errorText}>{error}</Text>}

        {!loading && !error && (
          <Card containerStyle={styles.cardContainer}>
            <Table borderStyle={{ borderWidth: 2, borderColor: '#c8e1ff' }}>
              <Row
                data={['ID', 'Name', 'Email', 'Actions']}
                style={styles.head}
                textStyle={styles.headText}
              />
              {renderTableData()}
            </Table>
          </Card>
        )}

<Modal animationType="slide" transparent={true} visible={isModalVisible}>
          <View style={styles.modalContainer}>
            <View style={styles.modalContent}>
              <Text style={styles.modalTitle}>Booking Details</Text>

              <View style={styles.centered}>
                {selectedCustomer?.image && (
                  <Image source={profile} style={styles.customerImage} />
                )}
              </View>

              <View style={styles.detailsContainer}>
              <Image source={require("../assets/user.jpg")} style={styles.customerImage} />

                <Text style={styles.detailText}><Icon name="user" type="font-awesome" color="#517fa4" /> Name: {selectedCustomer?.name}</Text>
                <Text style={styles.detailText}><Icon name="envelope" type="font-awesome" color="#517fa4" /> Email: {selectedCustomer?.email}</Text>
                <Text style={styles.detailText}><Icon name="phone" type="font-awesome" color="#517fa4" /> Contact: {selectedCustomer?.contact}</Text>
                
              </View>

              <TouchableOpacity onPress={() => setModalVisible(false)}>
                <Text style={styles.closeButton}>Close</Text>
              </TouchableOpacity>
            </View>
          </View>
        </Modal>
      </View>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  cardContainer: {
    width: '80%',
  },
  head: { height: 40, backgroundColor: '#f1f8ff' },
  headText: { margin: 6 },
  text: { margin: 6 },
  errorText: {
    color: 'red',
    marginBottom: 10,
  },
  modalContainer: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  modalContent: {
    backgroundColor: 'white',
    padding: 20,
    borderRadius: 10,
    elevation: 5,
  },
  modalTitle: {
    fontSize: 20,
    fontWeight: 'bold',
    marginBottom: 10,
  },
  closeButton: {
    color: 'blue',
    marginTop: 10,
    textAlign: 'center',
  },
  customerImage: {
    width: 100,
    height: 100,
    borderRadius: 50,
    marginBottom: 10,
    marginLeft:50
  },
});

export default CustomerScreen;
