import React, { useState, useEffect } from 'react';
import { View, Text, ScrollView, StyleSheet, Modal, TouchableOpacity, Image, ImageBackground, ActivityIndicator } from 'react-native';
import { Table, Row } from 'react-native-table-component';
import { Card, Icon } from 'react-native-elements';

const CustomerScreen = ({ navigation }) => {
  const [customers, setCustomers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [selectedCustomer, setSelectedCustomer] = useState(null);
  const [isModalVisible, setModalVisible] = useState(false);
  const profile = require("../assets/user.jpg");
  const backgroundImage = require("../assets/bg2.jpg");

  useEffect(() => {
    // Fetch customer data when the component mounts
    fetchCustomerData();
  }, []);

  const fetchCustomerData = async () => {
    try {
      const response = await fetch('http://10.30.19.146:3001/api/customer');

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
    return customers.map((customer, index) => (
      <Row
        key={customer.id}
        data={[
          (index + 1).toString(), // Display serial number (index + 1)
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
    <ImageBackground source={backgroundImage} style={styles.backgroundImage}>
      <View style={styles.container}>
     

        <ScrollView style={styles.scrollView}>
          {loading && <ActivityIndicator size="large" color="#fff" style={styles.loadingIndicator} />}
          {error && <Text style={styles.errorText}>{error}</Text>}

          {!loading && !error && (
            <Card containerStyle={styles.cardContainer}>
              <Table borderStyle={{ borderWidth: 2, borderColor: '#c8e1ff' }}>
                <Row
                  data={['Sr No', 'Name', 'Email', 'Actions']}
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
                {/* Modal content here */}
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
                  <Text style={styles.detailText}><Icon name="map" type="font-awesome" color="#517fa4" /> Location: {selectedCustomer?.location}</Text>
                  <Text style={styles.detailText}><Icon name="calendar" type="font-awesome" color="#517fa4" /> Booking Date: {selectedCustomer?.date}</Text>
                  <Text style={styles.detailText}><Icon name="clock-o" type="font-awesome" color="#517fa4" /> Start Time: {selectedCustomer?.starttime}</Text>
                  <Text style={styles.detailText}><Icon name="clock-o" type="font-awesome" color="#517fa4" /> End Time: {selectedCustomer?.endtime}</Text>
                  <Text style={styles.detailText}><Icon name="user" type="font-awesome" color="#517fa4" /> Adults: {selectedCustomer?.adults}</Text>
                  <Text style={styles.detailText}><Icon name="user" type="font-awesome" color="#517fa4" /> Children: {selectedCustomer?.children}</Text>
                  <Text style={styles.detailText}><Icon name="user" type="font-awesome" color="#517fa4" /> Young Children: {selectedCustomer?.young_children}</Text>
                  {/* Add more details as needed */}
                </View>

                <TouchableOpacity onPress={() => setModalVisible(false)}>
                  <Text style={styles.closeButton}>Close</Text>
                </TouchableOpacity>
              </View>
            </View>
          </Modal>

        </ScrollView>
      </View>
    </ImageBackground>
  );
};

const styles = StyleSheet.create({
  backgroundImage: {
    flex: 1,
    resizeMode: 'cover',
  },
  container: {
    flex: 1,
  },
  header: {
    backgroundColor: 'rgba(0, 0, 0, 0.5)',
    padding: 15,
    alignItems: 'center',
  },
  headerText: {
    color: 'white',
    fontSize: 18,
  },
  scrollView: {
    // Additional styling for the ScrollView if needed
  },
  cardContainer: {
    width: 'auto', // Set the width to 100%
    marginVertical: 20,
    borderRadius: 10,
  },
  head: {
    height: 40,
    backgroundColor: 'rgba(241, 248, 255, 0.5)',
    borderTopWidth: 0, // Set the top border width to 0
  },

  headText: {
    margin: 6,
    fontWeight: 'bold',
  },
  text: {
    margin: 6,
  },
  loadingIndicator: {
    marginTop: 20,
  },
  errorText: {
    color: 'red',
    marginBottom: 10,
    textAlign: 'center',
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
    marginLeft: 50,
  },
  centered: {
    alignItems: 'center',
  },
  detailsContainer: {
    marginTop: 10,
  },
  detailText: {
    marginBottom: 5,
  },
});

export default CustomerScreen;
